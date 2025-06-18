<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\CategoriaGasto;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Gasto;
use Carbon\Carbon;

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
        1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
        5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
        9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
    ];
    $mesActual        = Carbon::now()->month;
    $mesesDisponibles = array_slice(
        $todosLosMeses,
        $mesActual - 1,
        12 - ($mesActual - 1),
        true
    );

    // 3) Recuperar categorías PARA EL SELECT
    $categorias = CategoriaGasto::all();

    // 4) Enviar TODO a la vista
    return view('Crear_Presupuesto', compact(
        'categorias',
        'saldoDisponible',
        'mesesDisponibles'
    ));
}

    /** Guardar uno o varios presupuestos para el mes */
    public function store(Request $request)
    {
        // 1) validación básica + mes obligatorio
        $request->validate([
            'mes'                         => 'required|integer|between:1,12',
            'presupuestos.*.categoria_id' => 'nullable|required_with:presupuestos.*.monto|distinct|exists:categorias_gastos,id_categoriaGasto',
            'presupuestos.*.monto'        => 'nullable|numeric|min:0.01',
        ], [
            'mes.required'                              => 'Debes seleccionar un mes.',
            'presupuestos.*.categoria_id.required_with' => 'Completa la categoría si pones un monto.',
            'presupuestos.*.categoria_id.distinct'      => 'No puedes repetir categoría en un mismo mes.',
        ]);

        $userId        = auth()->id();
        $mesSeleccionado = $request->input('mes');

        // 2) filtrar sólo filas completas
        $datos = collect($request->input('presupuestos', []))
            ->filter(fn($p) => !empty($p['categoria_id']) && 
                               isset($p['monto']) && $p['monto'] > 0);

        if ($datos->isEmpty()) {
            return back()
                ->withErrors(['Debes ingresar al menos un presupuesto válido.'])
                ->withInput();
        }

        // 3) evitar que la categoría ya exista para el mismo mes
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

        // 4) verificar saldo disponible
        $saldoDisponible = Ingreso::where('user_id', $userId)->sum('monto')
                          - Gasto::where('user_id', $userId)->sum('monto')
                          - Presupuesto::where('user_id', $userId)->sum('restante');
        $totalAsignado = $datos->sum('monto');
        if ($totalAsignado > $saldoDisponible) {
            return back()
                ->withErrors(['No tienes suficiente saldo para asignar esos presupuestos.'])
                ->withInput();
        }

        // 5) crear
        foreach ($datos as $item) {
            Presupuesto::create([
                'user_id'      => $userId,
                'mes'          => $mesSeleccionado,
                'categoria_id' => $item['categoria_id'],
                'monto'        => $item['monto'],
                'restante'     => $item['monto'],
            ]);
        }

        // mensaje con nombre de mes
        $meses = [
            1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
            5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
            9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
        ];
        $nombreMes = $meses[$mesSeleccionado];
        return back()->with('success', "Presupuestos creados para {$nombreMes}.");
    }

         public function indexnuevo()
    {
        $userId    = auth()->id();
        $mesActual = Carbon::now()->month;

        $presupuestos = Presupuesto::with('categoriaGasto')
            ->where('user_id', $userId)
            ->where('mes', $mesActual)           // ← filtramos por mes actual
            ->get()
            ->map(function ($p) {
                // cálculos de gastado/restante/progreso
                $p->gastado  = $p->monto - $p->restante;
                $ratio       = $p->monto > 0 ? $p->gastado / $p->monto : 0;
                $p->pct      = min(100, $ratio * 100);
                $p->bar_class = $ratio < 0.80
                    ? 'under-budget'
                    : ($ratio <= 1 ? 'near-budget' : 'over-budget');
                // alias de categoría para la vista
                $p->categoria = $p->categoriaGasto->nombre ?? 'Sin categoría';
                return $p;
            });

        return view('Presupuesto', compact('presupuestos'));
    }
public function index()
    {
        $presupuestos = Presupuesto::with('categoriaGasto')   // nombre de la categoría
            ->where('user_id', auth()->id())
            ->latest()                                        // más recientes primero
            ->get();

        return view('RegistroPresupuesto', compact('presupuestos'));
    }

    /* Eliminar presupuesto */
    public function destroy($id_Presupuesto)
    {
        // 1)  El presupuesto debe pertenecer al usuario
        $presupuesto = Presupuesto::where('id_Presupuesto', $id_Presupuesto)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 2)  ¿Hay gastos registrados en la misma categoría?
        $hayGastos = Gasto::where('user_id', $presupuesto->user_id)
            ->where('categoria_id', $presupuesto->categoria_id)
            ->exists();

        if ($hayGastos) {
            return back()
                ->with('error', 'No puedes eliminar este presupuesto porque ya existen gastos registrados en esa categoría.');
        }

        // 3)  Eliminar
        $presupuesto->delete();

        // 4)  Mensaje de confirmación
        return back()->with('success', 'Presupuesto eliminado correctamente.');
    }

    // app/Http/Controllers/PresupuestoController.php
    public function update(Request $request, $id_Presupuesto)
{
    // 1) Validar el nuevo monto
    $request->validate([
        'monto' => 'required|numeric|min:0.01',
    ], [
        'monto.min' => 'El monto debe ser al menos $0.01.',
    ]);

    // 2) Cargar el presupuesto
    $presupuesto = Presupuesto::where('id_Presupuesto', $id_Presupuesto)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // 3) Calcular cuánto se ha gastado ya en esa categoría y mes
    $gastado = Gasto::where('user_id', auth()->id())
        ->where('categoria_id', $presupuesto->categoria_id)
        ->whereMonth('fecha', $presupuesto->mes)
        ->sum('monto');

    // 4) Validar que el nuevo monto no sea menor que lo ya gastado
    if ($gastado > $request->monto) {
        return response()->json([
            'error' => "No puedes fijar un presupuesto de $" 
                       . number_format($request->monto, 2)
                       . " porque ya registraste gastos por $"
                       . number_format($gastado, 2)
                       . " en esa categoría."
        ], 422);
    }

    // 5) Recalcular restante y actualizar
    $presupuesto->monto     = $request->monto;
    $presupuesto->restante  = max(0, $request->monto - $gastado);
    $presupuesto->save();

    return response()->json(['status' => 'ok']);
}


}
