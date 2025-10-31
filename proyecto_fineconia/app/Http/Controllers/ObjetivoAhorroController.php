<?php

namespace App\Http\Controllers;

use App\Models\ObjetivoAhorro;
use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Gasto;
use App\Models\Presupuesto;
use Illuminate\Support\Facades\Auth;

class ObjetivoAhorroController extends Controller
{
    public function create()
    {
        return view('ObjetivosDeAhorro');
    }

    public function indexMostrar()
    {
        $userId = auth()->id();

        // Calcular saldo disponible
        $totalIngresos      = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestos  = Presupuesto::where('user_id', $userId)->sum('monto');
        $totalGastos        = Gasto::where('user_id', $userId)->sum('monto');
        $totalAhorros       = \App\Models\ObjetivoAhorro::where('user_id', $userId)->sum('monto_ahorrado');

        $saldoDisponible = $totalIngresos - $totalPresupuestos - $totalGastos - $totalAhorros;

        return view('Ahorro', compact('saldoDisponible'));
    }


    // ✅ Registrar un nuevo objetivo
    public function index()
    {
        $objetivos = ObjetivoAhorro::where('user_id', Auth::id())->get();

        return response()->json($objetivos);
    }
    public function store(Request $request)
    {
        // ✅ Validar límite de objetivos (máximo 100)
        $objetivosCount = ObjetivoAhorro::where('user_id', Auth::id())->count();
        if ($objetivosCount >= 100) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Has alcanzado el límite máximo de 100 objetivos.'
                ], 422);
            }

            return redirect()
                ->route('ahorro')
                ->with('error', 'Has alcanzado el límite máximo de 100 objetivos.');
        }

        $request->validate([
            'nombre'      => 'required|string|max:255',
            'monto'       => 'required|numeric|min:1',
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
        ]);

        $objetivo = ObjetivoAhorro::create([
            'user_id'     => Auth::id(),
            'nombre'      => $request->nombre,
            'monto'       => $request->monto,
            'fecha_desde' => $request->fecha_desde,
            'fecha_hasta' => $request->fecha_hasta,
        ]);

        // ✅ Si la petición viene de fetch/ajax, responder JSON
        if ($request->ajax()) {
            return response()->json([
                'status' => 'ok',
                'objetivo' => $objetivo
            ]);
        }

        return redirect()
            ->route('ahorro')
            ->with('success', 'Objetivo guardado con éxito.');
    }

    public function update(Request $request, $id)
    {
        $userId = auth()->id();
        $objetivo = \App\Models\ObjetivoAhorro::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // 🔹 Verificar si el objetivo ya tiene abonos
        $tieneAbonos = $objetivo->monto_ahorrado > 0;

        if ($tieneAbonos) {
            // ✅ Solo puede modificar nombre y fecha_hasta
            $request->validate([
                'nombre'      => 'required|string|max:255',
                'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
            ]);

            $objetivo->update([
                'nombre'      => $request->nombre,
                'fecha_hasta' => $request->fecha_hasta,
            ]);

            return response()->json([
                'success' => true,
            ]);
        } else {
            // ✅ Puede modificar todo
            $request->validate([
                'nombre'       => 'required|string|max:255',
                'monto'        => 'required|numeric|min:0.01',
                'fecha_desde'  => 'required|date',
                'fecha_hasta'  => 'required|date|after_or_equal:fecha_desde',
            ]);

            $objetivo->update([
                'nombre'       => $request->nombre,
                'monto'        => $request->monto,
                'fecha_desde'  => $request->fecha_desde,
                'fecha_hasta'  => $request->fecha_hasta,
            ]);

            return response()->json([
                'success' => true,
            ]);
        }
    }



    // ✅ Eliminar un objetivo
    public function destroy($id)
    {
        $userId = auth()->id();

        // Obtener objetivo
        $objetivo = ObjetivoAhorro::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Calcular saldo disponible actual
        $totalIngresos     = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestos = Presupuesto::where('user_id', $userId)->sum('monto');
        $totalGastos       = Gasto::where('user_id', $userId)->sum('monto');
        $totalAhorros      = ObjetivoAhorro::where('user_id', $userId)->sum('monto_ahorrado');

        $saldoDisponible = $totalIngresos - $totalPresupuestos - $totalGastos - $totalAhorros;

        // Monto ahorrado que se devolverá al saldo
        $montoDevuelto = $objetivo->monto_ahorrado;

        // Actualizar saldo disponible sumando el monto devuelto
        $nuevoSaldoDisponible = $saldoDisponible + $montoDevuelto;

        // Eliminar objetivo
        $objetivo->delete();

        return response()->json([
            'success' => true,
            'monto_devuelto' => $montoDevuelto,
            'nuevo_saldo' => $nuevoSaldoDisponible
        ]);
    }


    public function count()
    {
        $count = ObjetivoAhorro::where('user_id', Auth::id())->count();
        return response()->json(['count' => $count]);
    }

    // En ObjetivoAhorroController.php
    public function indexCentroUsuario()
    {
        $userId = auth()->id();

        // SALDO: total ingresos - total presupuestos
        $totalIngresos     = Ingreso::where('user_id', $userId)->sum('monto');
        $totalPresupuestos = Presupuesto::where('user_id', $userId)->sum('monto');
        $saldoDisponible   = $totalIngresos - $totalPresupuestos;

        // OBJETIVOS DEL USUARIO
        $objetivos = ObjetivoAhorro::where('user_id', $userId)->get();

        // Retorna la vista con datos
        return view('CentroDeObjetivo', compact('saldoDisponible', 'objetivos'));
    }
}

/* Crear objetivo de ahorro - backend - correctamente funcional */
