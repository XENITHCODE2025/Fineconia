<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//hola
class AhorroController extends Controller
{
    
 public function indexConsejos()
{
    return view('ConsejosDeAhorro'); // Ajusta el nombre de la vista según corresponda
}


public function indexGraficasAhorro()
{
    return view('GraficasDeObjetivos'); // Ajusta el nombre de la vista según corresponda
}
}
