<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Support\Facades\Auth;

class GraficasPresupuestoController extends Controller
{
    /* ─────────  VISTA  ───────── */
    public function index()
    {
        // resources/views/GraficasPresupuesto.blade.php
        return view('GraficasPresupuesto');
    }

    /* ───────  DATA JSON  ─────── */
    public function data()
    {
        $userId = Auth::id();

        $datos = Presupuesto::with('categoriaGasto')          // ← relación en el modelo
            ->where('user_id', $userId)
            ->selectRaw('categoria_id, SUM(monto) AS total')
            ->groupBy('categoria_id')
            ->get()
            ->map(fn ($p) => [
                'categoria' => $p->categoriaGasto->nombre ?? 'Sin categoría',
                'total'     => (float) $p->total,
            ]);

        return response()->json($datos);
    }
}
