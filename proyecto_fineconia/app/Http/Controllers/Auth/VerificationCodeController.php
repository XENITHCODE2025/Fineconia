<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RecuperacionContrasenaMail;

class VerificationCodeController extends Controller
{
    public function show()
    {
        return view('verificacion-de-codigo');
    }

   public function verificar(Request $request)
{
    $request->validate([
        'codigo' => 'required|string',
    ]);

    $datos = session('registro_pendiente');

    if (!$datos) {
        return redirect()->route('registro.form')->withErrors(['registro' => 'No hay un registro pendiente.']);
    }

    if ($request->codigo === $datos['verification_code']) {
        // Crear el usuario
        $user = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => $datos['password'],
            'miembro' => $datos['miembro'],
            'email_verified_at' => now(),
        ]);

        // Limpiar la sesión
        session()->forget('registro_pendiente');

        // Loguear al usuario si deseas (opcional)
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Registro y verificación exitosos');
    } else {
        return back()->withErrors(['codigo' => 'El código ingresado es incorrecto.'])->withInput();
    }
}


    public function showRecoveryForm()
    {
        return view('RecuperarContrasena');
    }

    public function sendRecoveryCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Correo no registrado'])->withInput();
        }

        $codigo = Str::random(6);
        $user->verification_code = $codigo;
        $user->save();

        Mail::to($user->email)->send(new RecuperacionContrasenaMail($codigo));

        return redirect()->route('password.verify')
            ->with('success', 'Código enviado a tu correo')
            ->with('email', $user->email);
    }

    public function showVerifyForm()
    {
        return view('VerificacionDeCodigoContra');
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['codigo' => 'required|string|size:6']);

        $user = User::where('verification_code', $request->codigo)->first();

        if (!$user) {
            return back()->withErrors(['codigo' => 'Código inválido'])->withInput();
        }

        $user->verification_code = null;
        $user->save();

        return redirect()->route('password.reset')
            ->with('email', $user->email);
    }

    public function showResetForm()
    {
        return view('CambiarContrasena');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Usuario no encontrado']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Contraseña actualizada correctamente');
    }
}