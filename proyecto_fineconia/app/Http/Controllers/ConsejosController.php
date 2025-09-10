<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consejo;

class ConsejosController extends Controller
{
    public function index()
    {
        // recuperar todos (puedes ordenarlos o filtrarlos si quieres)
        $consejos = Consejo::orderBy('categoria')->get();

        // enviar la colección a la vista
        return view('ConsejosDeAhorro', compact('consejos'));
    }

    // optional: detalle de un consejo si lo requieres
    public function show($id)
    {
        $consejo = Consejo::findOrFail($id);
        return response()->json($consejo);
    }

    public function getConsejo($id)
{
    $consejo = \App\Models\Consejo::findOrFail($id);
    return response()->json($consejo);
}

}
