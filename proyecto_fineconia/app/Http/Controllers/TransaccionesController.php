<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gasto;
use App\Models\Ingreso;
use App\Models\Presupuesto; // si luego lo necesitas

class TransaccionesController extends Controller
{
    /* =========================================================
       Muestra la vista principal (welcome) con las transacciones
       ========================================================= */
    public function index()
    {
        $userId = Auth::id();

        /* ----------  GASTOS  --------------------------------- */
        $gastos = Gasto::with('categoriaGasto')     // usa relación en el modelo
            ->where('user_id', $userId)
            ->get()
            ->map(function ($g) {
                return [
                    'id'          => $g->id_Gasto,
                    'fecha'       => $g->fecha,
                    'descripcion' => $g->descripcion,
                    'categoria'   => optional($g->categoriaGasto)->nombre,
                    'monto'       => $g->monto,
                    'tipo'        => 'Gasto',
                ];
            });

        /* ----------  INGRESOS  ------------------------------- */
        $ingresos = Ingreso::with('categoriaIngreso')
            ->where('user_id', $userId)
            ->get()
            ->map(function ($i) {
                return [
                    'id'          => $i->id_Ingreso,
                    'fecha'       => $i->fecha,
                    'descripcion' => $i->descripcion,
                    'categoria'   => optional($i->categoriaIngreso)->nombre,
                    'monto'       => $i->monto,
                    'tipo'        => 'Ingreso',
                ];
            });

        /* ----------  Unificar y ordenar  --------------------- */
        $transacciones = $gastos
            ->merge($ingresos)
            ->sortByDesc('fecha')
            ->values();

        return view('welcome', compact('transacciones'));
    }

    /* =========================================================
       Devuelve JSON filtrable para tu apartado de reportes
       (tipo = gasto | ingreso | null)
       ========================================================= */
    public function lista(Request $request)
    {
        $request->validate([
            'tipo'   => 'nullable|in:gasto,ingreso',
            'buscar' => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();
        $buscar = $request->buscar;
        $tipo   = $request->tipo;

        /* -------------------  GASTOS  ------------------------ */
        $gastos = Gasto::query()
            ->join('categorias_gastos  AS cg', 'cg.id_categoriaGasto', '=', 'gastos.categoria_id')
            ->where('gastos.user_id', $userId)
            ->when($buscar, function ($q) use ($buscar) {
                $q->where(function ($w) use ($buscar) {
                    $w->where('cg.nombre', 'like', "%$buscar%")
                      ->orWhere('gastos.descripcion', 'like', "%$buscar%");
                });
            })
            ->selectRaw("
                gastos.id_Gasto AS id,
                DATE_FORMAT(gastos.fecha,  '%d %M %Y') AS fecha,
                TIME_FORMAT(gastos.created_at, '%l:%i %p') AS hora,
                gastos.created_at            AS orden,
                'Gasto'                      AS tipo,
                cg.nombre                    AS categoria,
                gastos.monto,
                gastos.descripcion
            ");

        /* -------------------  INGRESOS  ---------------------- */
        $ingresos = Ingreso::query()
            ->join('categorias_ingresos AS ci', 'ci.id_categoriaIngreso', '=', 'ingresos.categoria_id')
            ->where('ingresos.user_id', $userId)
            ->when($buscar, function ($q) use ($buscar) {
                $q->where(function ($w) use ($buscar) {
                    $w->where('ci.nombre', 'like', "%$buscar%")
                      ->orWhere('ingresos.descripcion', 'like', "%$buscar%");
                });
            })
            ->selectRaw("
                ingresos.id_Ingreso AS id,
                DATE_FORMAT(ingresos.fecha,  '%d %M %Y') AS fecha,
                TIME_FORMAT(ingresos.created_at, '%l:%i %p') AS hora,
                ingresos.created_at           AS orden,
                'Ingreso'                     AS tipo,
                ci.nombre                     AS categoria,
                ingresos.monto,
                ingresos.descripcion
            ");

        /* -------------------  Resultado  --------------------- */
        $coleccion = match ($tipo) {
            'gasto'   => $gastos  ->orderByDesc('orden')->get(),
            'ingreso' => $ingresos->orderByDesc('orden')->get(),
            default   => $gastos->unionAll($ingresos)->get()
                               ->sortByDesc('orden')->values(),
        };

        // ocultamos la clave 'orden', usada solo para ordenar
        return response()->json($coleccion->map->except('orden'));
    }
}
