<?php
// app/Http/Controllers/GraficasController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Gasto;
use App\Models\Ingreso;

class GraficasController extends Controller
{
    /* ═════════════ 1) VISTA PRINCIPAL ═════════════ */
    public function index()
    {
        return view('Graficas');                     // resources/views/Graficas.blade.php
    }

    /* ═════════════ 2) MÉTODO GENÉRICO DE AGRUPACIÓN ═════════════ */
    /**
     * Obtiene sumatorias por MES + CATEGORÍA para Ingreso o Gasto
     * $modelo = Ingreso::class | Gasto::class
     */
    private function transacciones(string $modelo, $from, $to)
    {
        // ── Descubro tabla y sus joins dinámicamente ───────────────────────────
        $instancia = new $modelo;
        $tabla     = $instancia->getTable();         // 'ingresos' | 'gastos'

        if ($tabla === 'ingresos') {
            $joinTabla = 'categorias_ingresos';
            $joinClave = 'id_categoriaIngreso';
        } else {                                    // gastos
            $joinTabla = 'categorias_gastos';
            $joinClave = 'id_categoriaGasto';
        }

        // ── Query ──────────────────────────────────────────────────────────────
        return $modelo::query()
            ->join("$joinTabla as c", "c.$joinClave", '=', "$tabla.categoria_id")
            ->where("$tabla.user_id", Auth::id())
            ->when($from, fn ($q) => $q->whereDate("$tabla.fecha", '>=', $from))
            ->when($to,   fn ($q) => $q->whereDate("$tabla.fecha", '<=', $to))
            ->selectRaw("
                DATE_FORMAT($tabla.fecha, '%Y-%m') AS mes,
                c.nombre                           AS categoria,
                SUM($tabla.monto)                  AS total
            ")
            ->groupBy('mes', 'categoria')
            ->orderByDesc('mes')
            ->get()
            ->groupBy('mes');                      // ← mismo formato que antes
    }

    /* ---------- End-points JSON ---------- */
    public function gastosAgrupados(Request $r)
    {
        return response()->json(
            $this->transacciones(Gasto::class, $r->from, $r->to)
        );
    }

    public function ingresosAgrupados(Request $r)
    {
        return response()->json(
            $this->transacciones(Ingreso::class, $r->from, $r->to)
        );
    }

    /* ═════════════ 3) MIXTO: INGRESOS vs GASTOS / MES ═════════════ */
    public function ingresosYGastosPorMes(Request $request)
    {
        $userId       = Auth::id();
        $fechaInicio  = $request->query('inicio');  // 'YYYY-MM-DD' o null
        $fechaFin     = $request->query('fin');

        /* INGRESOS */
        $ingresos = DB::table('ingresos')
            ->selectRaw("DATE_FORMAT(fecha, '%Y-%m') AS mes, SUM(monto) AS total")
            ->where('user_id', $userId)
            ->when($fechaInicio && $fechaFin, fn ($q) =>
                $q->whereBetween('fecha', [$fechaInicio, $fechaFin]))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        /* GASTOS  */
        $gastos = DB::table('gastos')
            ->selectRaw("DATE_FORMAT(fecha, '%Y-%m') AS mes, SUM(monto) AS total")
            ->where('user_id', $userId)
            ->when($fechaInicio && $fechaFin, fn ($q) =>
                $q->whereBetween('fecha', [$fechaInicio, $fechaFin]))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return response()->json([
            'ingresos' => $ingresos,
            'gastos'   => $gastos,
        ]);
    }
}
