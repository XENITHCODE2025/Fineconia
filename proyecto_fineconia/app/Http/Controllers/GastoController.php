<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Presupuesto;
use Illuminate\Http\Request;


class GastoController extends Controller
{
    /* FORMULARIO  ─────────────────────────────────────────── */
    public function create()
    {
        $presupuestos = Presupuesto::with('categoriaGasto')
            ->where('user_id', auth()->id())
            ->where('restante', '>', 0)          // solo los que aún tienen saldo
            ->get();                             // tendrás nombre y restante

        return view('gastos', compact('presupuestos'));
    }

    /* GUARDAR GASTO  ──────────────────────────────────────── */
    public function store(Request $request)
    {
        $request->validate([
            'fecha'        => 'required|date',
            'descripcion'  => 'required|string|max:255',
            'categoria_id' => 'required|exists:presupuestos,categoria_id',
            'monto'        => 'required|numeric|min:0',
        ]);

        $userId      = auth()->id();
        $presupuesto = Presupuesto::where('user_id', $userId)
            ->where('categoria_id', $request->categoria_id)
            ->first();

        if (!$presupuesto) {
            return back()->withErrors([
                'categoria_id' => 'No tienes presupuesto para esa categoría.',
            ])->withInput();
        }

        if ($request->monto > $presupuesto->restante) {
            return back()->withErrors([
                'monto' => 'El gasto excede el presupuesto restante de $' .
                    number_format($presupuesto->restante, 2),
            ])->withInput();
        }

        /* Insertar gasto */
        Gasto::create([
            'user_id'      => $userId,
            'fecha'        => $request->fecha,
            'descripcion'  => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'monto'        => $request->monto,
        ]);

        /* Restar del presupuesto */
        $presupuesto->restante -= $request->monto;
        $presupuesto->save();

        return back()->with('success', 'Gasto registrado y presupuesto actualizado.');
    }
   public function destroy($id_Gasto)
{
    // 1) Localizar el gasto del usuario
    $gasto = Gasto::where('id_Gasto', $id_Gasto)
                  ->where('user_id', auth()->id())
                  ->firstOrFail();

    // 2) Buscar el presupuesto de la misma categoría
    $presupuesto = Presupuesto::where('user_id', auth()->id())
        ->where('categoria_id', $gasto->categoria_id)
        ->first();

    // 3) Devolver el monto eliminado al presupuesto
    if ($presupuesto) {
        $presupuesto->restante += $gasto->monto;

        // opcional: que nunca supere el límite original
        if ($presupuesto->restante > $presupuesto->monto) {
            $presupuesto->restante = $presupuesto->monto;
        }

        $presupuesto->save();
    }

    // 4) Eliminar el gasto
    $gasto->delete();

    return back()->with('success', 'Gasto eliminado y presupuesto actualizado.');
}

// app/Http/Controllers/GastoController.php
public function update(Request $request, $id)
{
    $request->validate([
        'monto' => 'required|numeric|min:0',
    ]);

    $gasto = Gasto::where('id_Gasto', $id)->firstOrFail();

    // ------------------------------------------------------------------
    // 1) Calcular cuánto aumentó / disminuyó el gasto
    // ------------------------------------------------------------------
    $diferencia = $request->monto - $gasto->monto;   // (+) si aumenta

    // 2) Buscar el presupuesto que corresponde a la categoría del gasto
    $presupuesto = Presupuesto::where('user_id', $gasto->user_id)
        ->where('categoria_id', $gasto->categoria_id)
        ->first();

    if ($presupuesto) {
        // Si el nuevo monto supera lo disponible → rechazar
        if ($diferencia > 0 && $diferencia > $presupuesto->restante) {
            return response()->json([
                'error' => 'El nuevo monto excede el presupuesto restante ($' .
                           number_format($presupuesto->restante, 2) . ').'
            ], 422);
        }

        // 3) Actualizar restante (positivo resta, negativo suma)
        $presupuesto->restante -= $diferencia;
        $presupuesto->save();
    }

    // 4) Guardar el nuevo monto del gasto
    $gasto->update(['monto' => $request->monto]);

    return response()->json(['status' => 'ok']);
}


}
