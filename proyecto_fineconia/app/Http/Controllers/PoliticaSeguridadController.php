<?php

namespace App\Http\Controllers;

use App\Models\PoliticaSeguridad;
use Illuminate\Http\Request;

class PoliticaSeguridadController extends Controller
{
    public function index()
    {
        $secciones = PoliticaSeguridad::orderBy('orden')->get();
        return view('PoliticaSeguridad', compact('secciones'));
    }
}
