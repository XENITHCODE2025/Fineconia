<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CambiarContrasenaController extends Controller
{
    public function show()
    {
        return view('CambiarContrasena');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nueva_contrasena' => 'required|min:6',
            'confirmar_contrasena' => 'required|same:nueva_contrasena',
        ]);

        $email = Session::get('email_recuperacion');

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = Hash::make($request->nueva_contrasena);
            $user->save();

            // Limpiamos sesión
            Session::forget('codigo_recuperacion');
            Session::forget('email_recuperacion');

            return redirect()->route('login')->with('success', 'Contraseña actualizada con éxito.');
        }

        return back()->withErrors(['email' => 'No se encontró el usuario.']);
    }
}
