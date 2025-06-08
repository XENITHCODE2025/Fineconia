<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Ingreso;

class TransaccionesController extends Controller
{
    public function index()
    {
        $gastos = Gasto::select('id_Gasto','fecha', 'descripcion', 'categoria', 'monto')
            ->get()
            ->map(function ($item) {
                $item->tipo = 'Gasto';
                return $item;
            });

        $ingresos = Ingreso::select('Id_Ingreso','fecha', 'descripcion', 'categoria', 'monto')
            ->get()
            ->map(function ($item) {
                $item->tipo = 'Ingreso';
                return $item;
            });

        $transacciones = $gastos->concat($ingresos)->sortByDesc('fecha')->values();

        return view('welcome', compact('transacciones'));
    }

     public function lista(Request $request)
    {
        // 1) Validaciones rápidas
        $request->validate([
            'tipo'   => 'nullable|in:gasto,ingreso',
            'buscar' => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();                 // solo ver transacciones del usuario logueado
        $buscar = $request->buscar;
        $tipo   = $request->tipo;             // 'gasto' | 'ingreso' | null

        // 2) Base queries con filtros comunes ---------------------------------
       // ----- GASTOS -----
// ----- GASTOS -----
$gastos = Gasto::query()
    ->selectRaw("
        id_gasto   AS id,
        DATE_FORMAT(fecha, '%d %M %Y') AS fecha,
        TIME_FORMAT(created_at, '%l:%i %p') AS hora,
        created_at AS orden,                 
        'Gasto'  AS tipo,
        categoria,
        monto,
        descripcion
    ")
    ->where('user_id', $userId)
    ->when($buscar, function ($q) use ($buscar) {
        $q->where(function ($w) use ($buscar) {
            $w->where('categoria', 'like', "%$buscar%")
              ->orWhere('descripcion', 'like', "%$buscar%");
        });
    });

 // ----- INGRESOS -----
 $ingresos = Ingreso::query()
    ->selectRaw("
        id_ingreso AS id,
        DATE_FORMAT(fecha, '%d %M %Y') AS fecha,
        TIME_FORMAT(created_at, '%l:%i %p') AS hora,
        created_at AS orden,                 
        'Ingreso' AS tipo,
        categoria,
        monto,
        descripcion
    ")
    ->where('user_id', $userId)
    ->when($buscar, function ($q) use ($buscar) {
        $q->where(function ($w) use ($buscar) {
            $w->where('categoria', 'like', "%$buscar%")
              ->orWhere('descripcion', 'like', "%$buscar%");
        });
    });

    $coleccion = match ($tipo) {
     'gasto'   => $gastos->orderByDesc('orden')->get(),
     'ingreso' => $ingresos->orderByDesc('orden')->get(),
     default   => $gastos->unionAll($ingresos)->get()
                  ->sortByDesc('orden')->values(),   // 👈 usa el timestamp
    };

 // ya no hace falta volver a ordenar; $coleccion llega con el más reciente arriba
   return response()->json($coleccion->makeHidden('orden')); // ocultamos la clave extra

    }
}           