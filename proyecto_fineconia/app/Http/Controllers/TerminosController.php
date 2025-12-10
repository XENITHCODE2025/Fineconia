<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TerminoCondicion;

class TerminosController extends Controller
{
    public function index()
    {
        $secciones = TerminoCondicion::orderBy('orden')->get();
        return view('TerminosCondiciones', compact('secciones'));
    }
}
