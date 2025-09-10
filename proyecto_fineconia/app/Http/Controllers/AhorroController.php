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
    // Traer todos los consejos
    $all = \App\Models\Consejo::all();

    // Definimos las categorías que usamos en la UI (slug => label)
    $categories = [
        'presupuesto' => 'Presupuesto',
        'compras'     => 'Compras Inteligentes',
        'energia'     => 'Energía y Servicio',
        'metas'       => 'Metas de ahorro',
        'familiar'    => 'Familiar',
    ];

    // Agrupamos los consejos por slug intentando detectar coincidencias en el campo `categoria`.
    // Esto hace la vista más tolerante si en la BD el texto es "Compras inteligentes" o "Compras".
    $consejosBySlug = [];
    foreach ($categories as $slug => $label) {
        $keywords = []; // palabras clave para detectar esa categoría en la columna `categoria`
        switch ($slug) {
            case 'presupuesto': $keywords = ['presupuesto']; break;
            case 'compras':     $keywords = ['compra','compras','compras inteligentes']; break;
            case 'energia':     $keywords = ['energia','servicio','energía']; break;
            case 'metas':       $keywords = ['meta','metas','ahorro']; break;
            case 'familiar':    $keywords = ['familiar','familia']; break;
        }

        $consejosBySlug[$slug] = $all->filter(function($c) use ($keywords) {
            $cat = mb_strtolower($c->categoria ?? '');
            foreach ($keywords as $kw) {
                if (strpos($cat, mb_strtolower($kw)) !== false) return true;
            }
            return false;
        })->values();
    }

    return view('ConsejosDeAhorro', compact('categories', 'consejosBySlug'));
}

    public function indexGraficasAhorro()
    {
        return view('GraficasDeObjetivos');
    }


}