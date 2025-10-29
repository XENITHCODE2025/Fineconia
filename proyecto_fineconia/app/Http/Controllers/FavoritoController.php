<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    // Marcar / desmarcar guía como favorita
    public function toggle(Request $request)
    {
        $userId = Auth::id();
        $guiaPath = $request->input('guia_path');

        $favorito = Favorito::where('user_id', $userId)
            ->where('guia_path', $guiaPath)
            ->first();

        if ($favorito) {
            $favorito->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorito::create(['user_id' => $userId, 'guia_path' => $guiaPath]);
            return response()->json(['status' => 'added']);
        }
    }

    // Obtener todas las guías favoritas del usuario
    public function getUserFavoritos()
    {
        $favoritos = Favorito::where('user_id', Auth::id())
            ->pluck('guia_path')
            ->toArray();

        return response()->json($favoritos);
    }
}
