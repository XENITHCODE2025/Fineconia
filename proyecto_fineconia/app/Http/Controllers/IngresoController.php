<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\CategoriaIngreso;

class IngresoController extends Controller
{
    public function create()
    {
        $categorias = CategoriaIngreso::all();
        return view('ingresos', compact('categorias'));  // Asegúrate de que la vista exista en resources/views/gastos/create.blade.php
    }

    // Guardar el ingreso en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias_ingresos,id_categoriaIngreso',
            'monto' => 'required|numeric|min:0',
        ]);

        $ingreso = new Ingreso();
        $ingreso->descripcion = $request->descripcion;
        $ingreso->categoria_id = $request->categoria_id; // Asegúrate de que este campo exista en tu modelo Ingreso
        $ingreso->monto = $request->monto;
        $ingreso->fecha = $request->fecha;
        $ingreso->user_id = auth()->id(); // Asociar al usuario autenticado
        $ingreso->save();



        return redirect()->back()->with('success', 'Ingreso registrado exitosamente');
    }

    public function destroy($id_Ingreso)
    {
        $ingreso = Ingreso::where('id_Ingreso', $id_Ingreso)->firstOrFail();
        $ingreso->delete();
        return redirect('/gastos-ingresos')->with('success', 'Ingreso eliminado correctamente.');
    }

    // IngresoController.php
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias_ingresos,id_categoriaIngreso',
            'monto' => 'required|numeric'
        ]);

        $ingreso = Ingreso::findOrFail($id);
        $ingreso->update([
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'monto' => $request->monto
        ]);

        return response()->json(['status' => 'ok']);
    }
}
