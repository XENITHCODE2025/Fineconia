<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoVerificacionMail;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('REGRISTRO'); // Asegurate que el archivo esté en views/auth
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'miembro' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generar código de verificación
        $codigo = Str::random(6);

        // Guardar los datos del usuario en la sesión (NO se crea en la base aún)
        session([
            'registro_pendiente' => [
                'name' => $request->nombre . ' ' . $request->apellido,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'miembro' => $request->miembro,
                'verification_code' => $codigo,
            ],
        ]);

        // Enviar el código de verificación por correo
        Mail::to($request->email)->send(new CodigoVerificacionMail($codigo));

        // Redirigir a la vista donde el usuario va a ingresar el código
        return redirect()->route('verificacion.codigo');
    }
}
