<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\CategoriaGasto;
use App\Models\Ingreso;
use Illuminate\Http\Request;

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
}
