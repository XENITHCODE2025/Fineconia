<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\CategoriaGasto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GraficasPresupuestoController extends Controller
{
    /**
     * Mostrar la vista con filtros
     */
    public function index()
    {
        // Pasamos todas las categorías para el filtro
        $categories = CategoriaGasto::all();

        return view('GraficasPresupuesto', compact('categories'));
    }

    /**
     * Devuelve los datos agregados en JSON, aplicando filtros de año, mes y categoría
     */
    public function data(Request $request)
    {
        $userId     = Auth::id();
        $year       = $request->input('year');
        $month      = $request->input('month');
        $categoryId = $request->input('category');

        $query = Presupuesto::with('categoriaGasto')
                     ->where('user_id', $userId);

        // Filtrar por año de creación (created_at)
        if ($year) {
            $query->whereYear('created_at', $year);
        }
        // Filtrar por mes del campo “mes”
        if ($month) {
            $query->where('mes', $month);
        }
        // Filtrar por categoría
        if ($categoryId) {
            $query->where('categoria_id', $categoryId);
        }

        $datos = $query
            ->selectRaw('categoria_id, SUM(monto) AS total')
            ->groupBy('categoria_id')
            ->get()
            ->map(function ($p) {
                return [
                    'categoria' => $p->categoriaGasto->nombre ?? 'Sin categoría',
                    'total'     => (float) $p->total,
                ];
            });

        return response()->json($datos);
    }
}
