<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ingreso;
use App\Models\Presupuesto;
use App\Models\Gasto;
use App\Models\ObjetivoAhorro;
use Illuminate\Support\Facades\Auth;


//hola

class AhorroController extends Controller
{
    /** Mostrar página de ahorro con saldo */
    public function abonar(Request $request, $id)
    {

        $request->validate([
            'cantidad' => 'required|numeric|min:0.01'
        ]);

        $userId = Auth::id();
        $objetivo = ObjetivoAhorro::where('id', $id)->where('user_id', $userId)->firstOrFail();

        // Calcular saldo disponible
        $totalIngresos      = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestado = Presupuesto::where('user_id', $userId)->sum('monto');
        $totalGastos        = Gasto::where('user_id', $userId)->sum('monto');
        $saldoDisponible    = $totalIngresos - $totalPresupuestado - $totalGastos - $objetivo->monto_ahorrado;

        if ($request->cantidad > $saldoDisponible) {
            return response()->json(['error' => 'Saldo insuficiente para realizar el abono'], 400);
        }
        if ($objetivo->monto_ahorrado >= $objetivo->monto) {
            return response()->json(['error' => 'Este objetivo ya fue completado 🎉'], 400);
        }

        // Sumar al monto ahorrado
        $objetivo->monto_ahorrado += $request->cantidad;
        $objetivo->save();

        return response()->json([
            'success' => true,
            'nuevo_monto' => $objetivo->monto_ahorrado,
            'meta' => $objetivo->monto
        ]);
    }

    public function create()
    {
        //
    }

    public function indexConsejos()
    {
        return view('ConsejosDeAhorro');
    }

    public function indexGraficasAhorro()
    {
        return view('GraficasDeObjetivos');
    }
}