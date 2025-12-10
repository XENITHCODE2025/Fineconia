<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   public function update(Request $request)
{
    try {

        if (!Auth::check()) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $user = Auth::user();

        // ✅Validar
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'miembro' => 'required|string|max:255',
            'imagen'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        logger("Datos recibidos", $request->all());

        // -------- IMAGEN --------
        if ($request->hasFile('imagen')) {

            $imagen = $request->file('imagen');

            if (!$imagen->isValid()) {
                throw new \Exception("Imagen inválida.");
            }

            $directorio = public_path('storage/perfil');

            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true);
                logger("Directorio creado: ", [$directorio]);
            }

            // Borrar imagen anterior
            if ($user->imagen_url && file_exists(public_path($user->imagen_url))) {
                unlink(public_path($user->imagen_url));
                logger("Imagen antigua eliminada");
            }

            $nombre = uniqid() . "_" . time() . "." . $imagen->getClientOriginalExtension();

            // Mover archivo
            $imagen->move($directorio, $nombre);

            $user->imagen_url = 'storage/perfil/' . $nombre;

            logger("Imagen guardada correctamente", [$user->imagen_url]);
        }

        // -------- DATOS --------
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'miembro' => $request->miembro
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perfil actualizado correctamente'
        ]);

    } catch (\Throwable $e) {

        // 🔥 DEVOLVER ERROR DETALLADO AL NAVEGADOR
        return response()->json([
            'error' => true,
            'mensaje' => $e->getMessage(),
            'archivo' => $e->getFile(),
            'linea' => $e->getLine()
        ], 500);
    }
}


    public function edit()
    {
        return view('perfil'); 
    }
}
