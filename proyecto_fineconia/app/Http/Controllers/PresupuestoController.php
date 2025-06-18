<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\CategoriaGasto;
use App\Models\Ingreso;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PresupuestoController extends Controller
{
    /** Mostrar formulario */
    public function create(Request $request)
    {
        $userId = auth()->id();

        // 1) Calcular saldo disponible
        $totalIngresos      = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestado = Presupuesto::where('user_id', $userId)->sum('monto');
        $saldoDisponible    = $totalIngresos - $totalPresupuestado;

        // 2) Construir array de meses desde el mes actual
        $todosLosMeses = [
            1  => 'Enero',   2  => 'Febrero', 3  => 'Marzo',
            4  => 'Abril',   5  => 'Mayo',    6  => 'Junio',
            7  => 'Julio',   8  => 'Agosto',  9  => 'Septiembre',
            10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
        ];
        $mesActual        = Carbon::now()->month;
        $mesesDisponibles = array_slice(
            $todosLosMeses,
            $mesActual - 1,
            12 - ($mesActual - 1),
            true
        );

        // 3) Recuperar categorías para el select
        $categorias = CategoriaGasto::all();

        // 4) Enviar datos a la vista
        return view('Crear_Presupuesto', compact(
            'categorias',
            'saldoDisponible',
            'mesesDisponibles'
        ));
    }

    /** Guardar uno o varios presupuestos para el mes */
    public function store(Request $request)
    {
        // 1) Validación básica + mes obligatorio
        $request->validate([
            'mes'                         => 'required|integer|between:1,12',
            'presupuestos.*.categoria_id' => 'nullable|required_with:presupuestos.*.monto|distinct|exists:categorias_gastos,id_categoriaGasto',
            'presupuestos.*.monto'        => 'nullable|numeric|min:0.01',
        ], [
            'mes.required'                              => 'Debes seleccionar un mes.',
            'presupuestos.*.categoria_id.required_with' => 'Completa la categoría si pones un monto.',
            'presupuestos.*.categoria_id.distinct'      => 'No puedes repetir categoría en un mismo mes.',
        ]);

        $userId          = auth()->id();
        $mesSeleccionado = $request->input('mes');

        // 2) Filtrar solo filas completas
        $datos = collect($request->input('presupuestos', []))
            ->filter(fn($p) => !empty($p['categoria_id']) && isset($p['monto']) && $p['monto'] > 0);

        if ($datos->isEmpty()) {
            return back()
                ->withErrors(['Debes ingresar al menos un presupuesto válido.'])
                ->withInput();
        }

        // 3) Evitar duplicados del mismo mes
        $yaAsignadas = Presupuesto::where('user_id', $userId)
            ->where('mes', $mesSeleccionado)
            ->pluck('categoria_id')
            ->toArray();

        foreach ($datos as $item) {
            if (in_array($item['categoria_id'], $yaAsignadas)) {
                $cat = CategoriaGasto::find($item['categoria_id'])->nombre;
                return back()
                    ->withErrors(["Ya existe un presupuesto para “{$cat}” en ese mes."])
                    ->withInput();
            }
        }

        // 4) Verificar saldo disponible
        $saldoDisponible = Ingreso::where('user_id', $userId)->sum('monto')
                          - Gasto::where('user_id', $userId)->sum('monto')
                          - Presupuesto::where('user_id', $userId)->sum('restante');
        $totalAsignado = $datos->sum('monto');

        if ($totalAsignado > $saldoDisponible) {
            return back()
                ->withErrors(['No tienes suficiente saldo para asignar esos presupuestos.'])
                ->withInput();
        }

        // 5) Crear presupuestos
        foreach ($datos as $item) {
            Presupuesto::create([
                'user_id'      => $userId,
                'mes'          => $mesSeleccionado,
                'categoria_id' => $item['categoria_id'],
                'monto'        => $item['monto'],
                'restante'     => $item['monto'],
            ]);
        }

        // Mensaje con nombre del mes
        $meses     = [
            1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
            5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
            9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
        ];
        $nombreMes = $meses[$mesSeleccionado] ?? $mesSeleccionado;
        return back()->with('success', "Presupuestos creados para {$nombreMes}.");
    }

    /** Listar solo presupuestos del mes actual (Dashboard) */
    public function indexnuevo()
    {
        $userId    = auth()->id();
        $mesActual = Carbon::now()->month;

        $presupuestos = Presupuesto::with('categoriaGasto')
            ->where('user_id', $userId)
            ->where('mes', $mesActual)
            ->get()
            ->map(function ($p) {
                $p->gastado   = $p->monto - $p->restante;
                $ratio        = $p->monto > 0 ? $p->gastado / $p->monto : 0;
                $p->pct       = min(100, $ratio * 100);
                $p->bar_class = $ratio < 0.80
                    ? 'under-budget'
                    : ($ratio <= 1 ? 'near-budget' : 'over-budget');
                $p->categoria = $p->categoriaGasto->nombre ?? 'Sin categoría';
                return $p;
            });

        return view('Presupuesto', compact('presupuestos'));
    }

    /** Vista de todos los registros (para ajustar) */
    public function index()
    {
        $presupuestos = Presupuesto::with('categoriaGasto')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('RegistroPresupuesto', compact('presupuestos'));
    }

    /** Eliminar presupuesto */
    public function destroy($id_Presupuesto)
    {
        // 1) Localizar presupuesto
        $presupuesto = Presupuesto::where('id_Presupuesto', $id_Presupuesto)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 2) ¿Hay gastos en esa categoría y en ese mes?
        $hayGastos = Gasto::where('user_id', auth()->id())
            ->where('categoria_id', $presupuesto->categoria_id)
            ->whereMonth('fecha', $presupuesto->mes)
            ->exists();

        if ($hayGastos) {
            return back()
                ->with('error', 'No puedes eliminar este presupuesto porque ya existen gastos registrados en esa categoría para ese mes.');
        }

        // 3) Eliminar
        $presupuesto->delete();

        // 4) Confirmar
        return back()->with('success', 'Presupuesto eliminado correctamente.');
    }

    /** Actualizar presupuesto */
    public function update(Request $request, $id_Presupuesto)
    {
        // 1) Validar nuevo monto
        $request->validate([
            'monto' => 'required|numeric|min:0.01',
        ], [
            'monto.min' => 'El monto debe ser al menos $0.01.',
        ]);

        // 2) Cargar presupuesto
        $presupuesto = Presupuesto::where('id_Presupuesto', $id_Presupuesto)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 3) Sumar gastos del mismo mes y categoría
        $gastado = Gasto::where('user_id', auth()->id())
            ->where('categoria_id', $presupuesto->categoria_id)
            ->whereMonth('fecha', $presupuesto->mes)
            ->sum('monto');

        // 4) No permitir monto < gastado
        if ($gastado > $request->monto) {
            return response()->json([
                'error' => "No puedes fijar un presupuesto de $" 
                           . number_format($request->monto, 2)
                           . " porque ya gastaste $"
                           . number_format($gastado, 2) . "."
            ], 422);
        }

        // 5) Recalcular restante y guardar
        $presupuesto->monto    = $request->monto;
        $presupuesto->restante = max(0, $request->monto - $gastado);
        $presupuesto->save();

        return response()->json(['status' => 'ok']);
    }
}
