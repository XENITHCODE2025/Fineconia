<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GastoController extends Controller
{
    /* FORMULARIO  ─────────────────────────────────────────── */
    public function create()
    {
        $userId    = auth()->id();
        $mesActual = Carbon::now()->month;

        // Trae solo los presupuestos del mes actual
        $presupuestos = Presupuesto::with('categoriaGasto')
            ->where('user_id', $userId)
            ->where('mes', $mesActual)
            ->get();

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

        $userId    = auth()->id();
        $mesActual = Carbon::now()->month;

        // 1) Verifica que exista presupuesto para esa categoría y mes
        $presupuesto = Presupuesto::where('user_id', $userId)
            ->where('categoria_id', $request->categoria_id)
            ->where('mes', $mesActual)
            ->first();

        if (! $presupuesto) {
            return back()
                ->withErrors(['categoria_id' => 'No tienes presupuesto para esa categoría en el mes actual.'])
                ->withInput();
        }

        // 2) Inserta el gasto
        $gasto = Gasto::create([
            'user_id'      => $userId,
            'fecha'        => $request->fecha,
            'descripcion'  => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'monto'        => $request->monto,
        ]);

        // 3) Descontar el monto del presupuesto restante
        $presupuesto->restante -= $request->monto;
        if ($presupuesto->restante < 0) {
            $presupuesto->restante = 0;
        }
        $presupuesto->save();

        return back()->with('success', 'Gasto registrado y presupuesto actualizado.');
    }

    /* ELIMINAR GASTO  ─────────────────────────────────────── */
    public function destroy($id_Gasto)
    {
        // 1) Localiza el gasto del usuario
        $gasto = Gasto::where('id_Gasto', $id_Gasto)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 2) Buscar el presupuesto de la misma categoría y mes
        $mesActual = Carbon::now()->month;
        $presupuesto = Presupuesto::where('user_id', auth()->id())
            ->where('categoria_id', $gasto->categoria_id)
            ->where('mes', $mesActual)
            ->first();

        // 3) Devolver el monto eliminado al presupuesto
        if ($presupuesto) {
            $presupuesto->restante += $gasto->monto;
            // No exceder el monto original
            if ($presupuesto->restante > $presupuesto->monto) {
                $presupuesto->restante = $presupuesto->monto;
            }
            $presupuesto->save();
        }

        // 4) Eliminar el gasto
        $gasto->delete();

        return back()->with('success', 'Gasto eliminado y presupuesto actualizado.');
    }

    /* ACTUALIZAR GASTO  ───────────────────────────────────── */
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0',
        ]);

        // 1) Localiza el gasto
        $gasto = Gasto::where('id_Gasto', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 2) Calcula diferencia
        $diferencia = $request->monto - $gasto->monto; // + si aumenta, - si disminuye

        // 3) Buscar presupuesto correspondiente
        $mesActual = Carbon::now()->month;
        $presupuesto = Presupuesto::where('user_id', $gasto->user_id)
            ->where('categoria_id', $gasto->categoria_id)
            ->where('mes', $mesActual)
            ->first();

        if ($presupuesto) {
            // Ajustar restante: restar diferencia (si es negativo, suma automática) probando
            $presupuesto->restante -= $diferencia;
            // Limitar entre 0 y monto original
            if ($presupuesto->restante < 0) {
                $presupuesto->restante = 0;
            } elseif ($presupuesto->restante > $presupuesto->monto) {
                $presupuesto->restante = $presupuesto->monto;
            }
            $presupuesto->save();
        }

        // 4) Guardar el nuevo monto del gasto
        $gasto->update(['monto' => $request->monto]);

        return response()->json(['status' => 'ok']);
    }
}
