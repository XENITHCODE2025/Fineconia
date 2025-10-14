<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjetivoAhorro;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    // Endpoint principal para obtener el historial con filtros
    public function obtenerHistorial(Request $request)
    {
        $userId = Auth::id();

        $query = ObjetivoAhorro::where('user_id', $userId);

        $fechaDesde = $request->input('fecha_desde');
        $fechaHasta = $request->input('fecha_hasta');
        $nombreObjetivo = $request->input('objetivo');

        if ($fechaDesde && $fechaHasta) {
            $query->whereBetween('fecha_desde', [$fechaDesde, $fechaHasta])
                  ->orWhereBetween('fecha_hasta', [$fechaDesde, $fechaHasta]);
        }

        if ($nombreObjetivo) {
            $query->where('nombre', 'LIKE', '%' . $nombreObjetivo . '%');
        }

        $historial = $query->orderBy('created_at', 'desc')->get();

        if ($historial->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontraron resultados para su búsqueda',
            ]);
        }

        // Agregamos el campo calculado "estado"
        $historial->transform(function ($item) {
            if ($item->monto_ahorrado >= $item->monto) {
                $item->estado = 'Finalizado';
            } elseif ($item->monto_ahorrado > 0) {
                $item->estado = 'En proceso';
            } else {
                $item->estado = 'Pendiente';
            }
            $item->fecha = $item->fecha_desde;
            $item->restante = $item->monto - $item->monto_ahorrado;
            return $item;
        });

        return response()->json([
            'status' => 'success',
            'data' => $historial
        ]);
    }

    // Endpoint para obtener todos los objetivos del usuario (para llenar el select)
    public function listarObjetivos()
    {
        $userId = Auth::id();
        $objetivos = ObjetivoAhorro::where('user_id', $userId)
            ->orderBy('nombre', 'asc')
            ->get(['id', 'nombre']);

        return response()->json([
            'status' => 'success',
            'data' => $objetivos
        ]);
    }
}
