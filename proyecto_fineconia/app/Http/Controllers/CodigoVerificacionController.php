<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CodigoVerificacionController extends Controller
{
    public function index()
    {
        return view('VerificacionDeCodigo');
    }

    public function verificarCodigo(Request $request)
    {
        $request->validate(['codigo' => 'required']);

        if ($request->codigo == Session::get('codigo_recuperacion')) {
            return redirect()->route('mostrar.formulario.cambiar.contrasena');
        } else {
            return redirect()->route('codigo.verificado.index')->withErrors(['codigo' => 'Código incorrecto.']);
        }
    }
}
