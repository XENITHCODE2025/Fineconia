<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function store(Request $request)
    {
        try {

            // VALIDACIONES
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|email|unique:admin_users,email',
                'password' => 'required|min:6',
                'rol' => 'required|string',
                'permisos' => 'nullable|array',
                'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            ]);

            // GUARDAR IMAGEN
            $imagenUrl = null;
            if ($request->hasFile('imagen')) {
                $imagenUrl = $request->file('imagen')->store('admin_users', 'public');
            }

            // CREAR USUARIO
            $admin = AdminUser::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => $request->rol,
                'permisos' => $request->permisos ?? [],
                'imagen_url' => $imagenUrl,
            ]);

            return response()->json([
                'status' => 'ok',
                'message' => 'Usuario administrador creado correctamente',
                'data' => $admin
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
