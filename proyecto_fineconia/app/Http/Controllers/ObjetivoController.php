<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    // Mostrar el formulario para crear un nuevo objetivo de ahorro
    public function create()
    {
        return view('ObjetivosDeAhorro');
    }
}