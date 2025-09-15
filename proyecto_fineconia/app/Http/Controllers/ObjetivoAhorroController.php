<?php

namespace App\Http\Controllers;

use App\Models\ObjetivoAhorro;
use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Gasto;
use App\Models\Presupuesto;
use Illuminate\Support\Facades\Auth;

class ObjetivoAhorroController extends Controller
{
    public function create()
    {
        return view('ObjetivosDeAhorro');
    }

    public function indexMostrar()
    {
        $userId = auth()->id();

        // Calcular saldo disponible
        $totalIngresos      = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestos  = Presupuesto::where('user_id', $userId)->sum('monto');
        $totalGastos        = Gasto::where('user_id', $userId)->sum('monto');
        $totalAhorros       = \App\Models\ObjetivoAhorro::where('user_id', $userId)->sum('monto_ahorrado');

        $saldoDisponible = $totalIngresos - $totalPresupuestos - $totalGastos - $totalAhorros;

        return view('Ahorro', compact('saldoDisponible'));
    }


    // ✅ Registrar un nuevo objetivo
    public function index()
    {
        $objetivos = ObjetivoAhorro::where('user_id', Auth::id())->get();

        return response()->json($objetivos);
    }
    public function store(Request $request)
{
    // ✅ Validar límite de objetivos (máximo 100)
    $objetivosCount = ObjetivoAhorro::where('user_id', Auth::id())->count();
    if ($objetivosCount >= 100) {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Has alcanzado el límite máximo de 100 objetivos.'
            ], 422);
        }
        
        return redirect()
            ->route('ahorro')
            ->with('error', 'Has alcanzado el límite máximo de 100 objetivos.');
    }

    $request->validate([
        'nombre'      => 'required|string|max:255',
        'monto'       => 'required|numeric|min:1',
        'fecha_desde' => 'required|date',
        'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
    ]);

    $objetivo = ObjetivoAhorro::create([
        'user_id'     => Auth::id(),
        'nombre'      => $request->nombre,
        'monto'       => $request->monto,
        'fecha_desde' => $request->fecha_desde,
        'fecha_hasta' => $request->fecha_hasta,
    ]);

    // ✅ Si la petición viene de fetch/ajax, responder JSON
    if ($request->ajax()) {
        return response()->json([
            'status' => 'ok',
            'objetivo' => $objetivo
        ]);
    }

    return redirect()
        ->route('ahorro')
        ->with('success', 'Objetivo guardado con éxito.');
}

    public function update(Request $request, $id)
    {
        $objetivo = ObjetivoAhorro::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nombre'      => 'required|string|max:255',
            'monto'       => 'required|numeric|min:1',
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
        ]);

        $objetivo->update($request->only(['nombre', 'monto', 'fecha_desde', 'fecha_hasta']));

        return response()->json([
            'message'  => 'Objetivo actualizado con éxito',
            'objetivo' => $objetivo,
        ]);
    }


    // ✅ Eliminar un objetivo
    public function destroy($id)
    {
        $objetivo = ObjetivoAhorro::where('user_id', Auth::id())->findOrFail($id);
        $objetivo->delete();

        return response()->json([
            'message' => 'Objetivo eliminado con éxito'
        ]);
    }
    public function count()
{
    $count = ObjetivoAhorro::where('user_id', Auth::id())->count();
    return response()->json(['count' => $count]);
}
}

/* Crear objetivo de ahorro - backend - correctamente funcional */
