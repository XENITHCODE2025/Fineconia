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
    public function destroy(Gasto $gasto)   // ← inyección implícita
    {
        $gasto->delete();

        return redirect()
            ->route('gastos-ingresos')
            ->with('success', 'Gasto eliminado correctamente.');
    }
    public function update(Request $request, Gasto $gasto)
{
    $request->validate([
        'descripcion'  => 'required|string|max:255',
        'categoria'    => 'required|string|max:100',
        'monto'        => 'required|numeric|min:0',
    ]);

    $gasto->update([
        'descripcion' => $request->descripcion,
        'categoria_id' => $request->categoria,  // viene del select
        'monto'       => $request->monto,
    ]);

    return response()->json(['ok' => true]);
}

}
