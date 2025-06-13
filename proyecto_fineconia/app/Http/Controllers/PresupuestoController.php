<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\CategoriaGasto;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Gasto;

class PresupuestoController extends Controller
{
    /* Mostrar formulario */
    public function create()
    {
        $userId = auth()->id();

        // saldo total de ingresos
        $totalIngresos = Ingreso::where('user_id', $userId)->sum('monto');

        // total ya presupuestado
        $totalPresupuestado = Presupuesto::where('user_id', $userId)->sum('monto');

        $saldoDisponible = $totalIngresos - $totalPresupuestado;

        $categorias = CategoriaGasto::all();

        return view('Crear_Presupuesto', compact('categorias', 'saldoDisponible'));
    }

    /* Guardar presupuesto */
    public function store(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'categoria_id' => 'required|exists:categorias_gastos,id_categoriaGasto|unique:presupuestos,categoria_id,NULL,id_Presupuesto,user_id,' . $userId,
            'monto'        => 'required|numeric|min:0',
        ]);

        // saldo y total presupuestado actuales
        $totalIngresos      = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestado = Presupuesto::where('user_id', $userId)->sum('monto');
        $saldoDisponible    = $totalIngresos - $totalPresupuestado;

        if ($request->monto > $saldoDisponible) {
            return back()->withErrors(['monto' => 'El monto excede tu saldo disponible.'])->withInput();
        }

        Presupuesto::create([
            'user_id'      => $userId,
            'categoria_id' => $request->categoria_id,
            'monto'        => $request->monto,
            'restante'     => $request->monto,
        ]);

        return redirect()->route('presupuesto')->with('success', 'Presupuesto creado.');
    }
        public function indexnuevo()
    {
        $userId = auth()->id();

        $presupuestos = Presupuesto::with('categoriaGasto')
            ->where('user_id', $userId)
            ->get()
            ->map(function ($p) {
                /* cálculos */
                $p->gastado   = $p->monto - $p->restante;          // lo ya usado
                $ratio        = $p->monto > 0 ? $p->gastado / $p->monto : 0;
                $p->pct       = min(100, $ratio * 100);           // ancho barra
                $p->barClass  = $ratio < .80   ? 'under-budget'
                               : ($ratio <= 1 ? 'near-budget'
                               : 'over-budget');
                /* ayuda para la vista */
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
        $request->validate([
            'monto' => 'required|numeric|min:0',
        ]);

        $presupuesto = Presupuesto::where('id_Presupuesto', $id_Presupuesto)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $presupuesto->ajustarMonto($request->monto);

        return response()->json(['status' => 'ok']);

        
    }

}
