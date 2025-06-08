<?php
// app/Http/Controllers/GraficasController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gasto;
use App\Models\Ingreso;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    /* ---------- 1) VISTA PRINCIPAL --------- */
    public function index()
    {
        return view('Graficas');   // resources/views/Graficas.blade.php
    }

    /* ---------- 2) DATOS AGRUPADOS --------- */
    private function transacciones($modelo, $from, $to)
    {
        return $modelo::where('user_id', Auth::id())
            ->when($from, fn ($q) => $q->whereDate('fecha', '>=', $from))
            ->when($to,   fn ($q) => $q->whereDate('fecha', '<=', $to))
            ->selectRaw("DATE_FORMAT(fecha, '%Y-%m') AS mes, categoria, SUM(monto) AS total")
            ->groupBy('mes', 'categoria')
            ->orderByDesc('mes')
            ->get()
            ->groupBy('mes');
    }

    public function gastosAgrupados(Request $r)
    {
        return response()->json($this->transacciones(Gasto::class, $r->from, $r->to));
    }

    public function ingresosAgrupados(Request $r)
    {
        return response()->json($this->transacciones(Ingreso::class, $r->from, $r->to));
    }

    public function ingresosYGastosPorMes(Request $request)
    {
        // 1) Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // 2) Leer parámetros “inicio” y “fin” de la query string (formato 'YYYY-MM-DD')
        $fechaInicio = $request->query('inicio', null);
        $fechaFin    = $request->query('fin', null);

        //
        // 3) Construir consulta de INGRESOS agrupados por mes
        //
        $queryIngresos = DB::table('ingresos')
            ->selectRaw("DATE_FORMAT(fecha, '%Y-%m') as mes, SUM(monto) as total")
            ->where('user_id', $userId);

        // Si se enviaron ambos parámetros “inicio” y “fin”, aplico filtro de rango
        if ($fechaInicio && $fechaFin) {
            $queryIngresos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $ingresos = $queryIngresos
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        //
        // 4) Construir consulta de GASTOS agrupados por mes
        //
        $queryGastos = DB::table('gastos')
            ->selectRaw("DATE_FORMAT(fecha, '%Y-%m') as mes, SUM(monto) as total")
            ->where('user_id', $userId);

        // Si se enviaron ambos parámetros “inicio” y “fin”, aplico filtro de rango
        if ($fechaInicio && $fechaFin) {
            $queryGastos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $gastos = $queryGastos
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        //
        // 5) Devolver JSON con los arreglos “ingresos” y “gastos”
        //
        return response()->json([
            'ingresos' => $ingresos,
            'gastos'   => $gastos,
        ]);
    }


}
