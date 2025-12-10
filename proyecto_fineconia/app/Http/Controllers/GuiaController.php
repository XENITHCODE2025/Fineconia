<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

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

  public function index1()
{
    // Obtener el parámetro y decodificarlo por si viene doblemente codificado
    $path = request('path');
    $path = urldecode($path);

    if (!$path) {
        abort(404, 'Ruta de guía no especificada');
    }

    // Verificamos que el archivo exista en el disco público
    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'La guía no existe o fue movida');
    }

    // Obtenemos información de la guía
    $nombreArchivo = pathinfo($path, PATHINFO_FILENAME);
    $categoria = basename(dirname($path));
    $urlArchivo = Storage::url($path);

    // Retornamos la vista con los datos
    return view('AquiVerGuia', [
        'titulo' => $nombreArchivo,
        'categoria' => $categoria,
        'urlArchivo' => $urlArchivo,
    ]);
}

}