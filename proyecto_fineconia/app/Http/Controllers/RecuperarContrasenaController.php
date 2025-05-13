<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Mail\VerificarCodigo2;
use App\Models\User;

class RecuperarContrasenaController extends Controller
{
    

    public function index() {
        return view('RecuperarContrasena');
    }
public function enviarCodigo(Request $request)
{
    $usuario = User::where('email', $request->email)->first();

    if ($usuario) {
        // Generar código aleatorio
        $codigo = rand(100000, 999999);

        // Guardar el código en la base de datos o en sesión (como prefieras)
        $usuario->codigo_verificacion = $codigo;
        $usuario->save();

        // Enviar correo con el código
        Mail::to($usuario->email)->send(new VerificarCodigo2($codigo));

        // Redireccionar a la vista donde el usuario ingresará el código
        return redirect()->route('VerificacionDeCodigo');
    } else {
        return back()->withErrors(['email' => 'No se encontró un usuario con ese correo.']);
    }
}

}
