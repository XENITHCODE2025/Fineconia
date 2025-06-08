<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Muestra la vista de Reportes Detallados.
     */
    public function index()
    {
        // Si más adelante necesitas datos, cárgalos aquí y pásalos con compact().
        return view('Reportes');   // resources/views/Reportes.blade.php
    }
}
