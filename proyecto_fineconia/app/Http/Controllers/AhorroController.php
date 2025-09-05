<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Presupuesto;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;

class AhorroController extends Controller
{
    /** Mostrar página de ahorro con saldo */
    public function index()
    {
        $userId = auth()->id();

        // Calcular saldo disponible
        $totalIngresos      = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestado = Presupuesto::where('user_id', $userId)->sum('monto');
        $totalGastos        = Gasto::where('user_id', $userId)->sum('monto');

        $saldoDisponible = $totalIngresos - $totalPresupuestado - $totalGastos;

        return view('Ahorro', compact('saldoDisponible'));
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
