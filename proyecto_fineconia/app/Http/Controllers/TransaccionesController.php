<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Ingreso;

class TransaccionesController extends Controller
{
    public function index()
    {
        $gastos = Gasto::select('id_Gasto','fecha', 'descripcion', 'categoria', 'monto')
            ->get()
            ->map(function ($item) {
                $item->tipo = 'Gasto';
                return $item;
            });

        $ingresos = Ingreso::select('Id_Ingreso','fecha', 'descripcion', 'categoria', 'monto')
            ->get()
            ->map(function ($item) {
                $item->tipo = 'Ingreso';
                return $item;
            });

        $transacciones = $gastos->concat($ingresos)->sortByDesc('fecha')->values();

        return view('welcome', compact('transacciones'));
    }
}
