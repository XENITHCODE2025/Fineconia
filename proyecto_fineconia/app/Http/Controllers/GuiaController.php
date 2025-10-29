<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class GuiaController extends Controller
{
    public function index()
    {
        // Obtenemos todas las categorías dentro de storage/app/public/guias
        $categorias = Storage::disk('public')->directories('guias');

        $guias = [];

        foreach ($categorias as $categoriaPath) {
            $archivos = Storage::disk('public')->files($categoriaPath);

            foreach ($archivos as $archivo) {
                // Obtenemos nombre base (sin extensión)
                $nombreArchivo = pathinfo($archivo, PATHINFO_FILENAME);

                // 🔹 Buscamos miniatura en la carpeta 'thumbnails'
                $categoriaNombre = basename($categoriaPath);
                $miniaturaJpg = 'thumbnails/' . $categoriaNombre . '/' . $nombreArchivo . '.jpg';
                $miniaturaPng = 'thumbnails/' . $categoriaNombre . '/' . $nombreArchivo . '.png';

                $miniatura = null;
                if (Storage::disk('public')->exists($miniaturaJpg)) {
                    $miniatura = $miniaturaJpg;
                } elseif (Storage::disk('public')->exists($miniaturaPng)) {
                    $miniatura = $miniaturaPng;
                }

                // Agregamos los datos de la guía
                $guias[] = [
                    'titulo' => $nombreArchivo,
                    'ruta' => $archivo,
                    'categoria' => $categoriaNombre,
                    'miniatura' => $miniatura, // será null si no existe
                ];
            }
        }

        // Pasamos las guías a la vista
        return view('Educacion', compact('guias'));
    }
}