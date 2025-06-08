<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;

class IngresoController extends Controller
{
    /**
     * Mostrar todos los ingresos del usuario autenticado
     * y el total acumulado.
     */
    public function index()
    {
        $userId = auth()->id();

        // Traer todos los ingresos del usuario, ordenados por fecha
        $ingresos = Ingreso::where('user_id', $userId)
                           ->orderBy('fecha', 'desc')
                           ->get();

        // Calcular total acumulado de ingresos
        $totalIngresos = Ingreso::totalPorUsuario($userId);

        return view('ingresos.index', compact('ingresos', 'totalIngresos'));
    }

    /**
     * Mostrar formulario para crear un nuevo ingreso.
     */
    public function create()
    {
        return view('ingresos.create');
    }

    /**
     * Validar y almacenar un nuevo ingreso.
     * Luego recalcula el total y redirige a listado.
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'fecha'       => 'required|date',
            'descripcion' => 'required|string|max:255',
            'categoria'   => 'required|string|max:100',
            'monto'       => 'required|numeric|min:0',
        ]);

        // Crear el ingreso
        Ingreso::create([
            'user_id'     => auth()->id(),
            'fecha'       => $request->fecha,
            'descripcion' => $request->descripcion,
            'categoria'   => $request->categoria,
            'monto'       => $request->monto,
        ]);

        // Recalcular total
        $totalIngresos = Ingreso::totalPorUsuario(auth()->id());

        // Redirigir a la lista con mensaje y total en sesión
        return redirect()
            ->route('ingresos.index')
            ->with([
                'success'       => 'Ingreso registrado correctamente.',
                'totalIngresos' => $totalIngresos,
            ]);
    }

    /**
     * Eliminar un ingreso y volver al listado.
     */
    public function destroy($id_Ingreso)
    {
        $ingreso = Ingreso::where('id_Ingreso', $id_Ingreso)
                          ->firstOrFail();
        $ingreso->delete();

        return redirect()
            ->route('ingresos.index')
            ->with('success', 'Ingreso eliminado correctamente.');
    }

    /**
     * Actualizar campos de un ingreso (AJAX).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'categoria'   => 'required|string|max:255',
            'monto'       => 'required|numeric',
        ]);

        $ingreso = Ingreso::findOrFail($id);
        $ingreso->update($request->only('descripcion', 'categoria', 'monto'));

        return response()->json(['status' => 'ok']);
    }
}
