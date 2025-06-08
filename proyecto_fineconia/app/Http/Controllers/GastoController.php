<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;

class GastoController extends Controller
{
    // Método para mostrar el formulario de creación de gasto
    public function create()
    {
        return view('gastos.create');  // Asegúrate de que la vista exista en resources/views/gastos/create.blade.php
    }

    // Método para guardar el gasto
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
        ]);



        $gasto = new Gasto();
        $gasto->descripcion = $request->descripcion;
        $gasto->categoria = $request->categoria;
        $gasto->monto = $request->monto;
        $gasto->fecha = $request->fecha;
        $gasto->user_id = auth()->id(); // Asociar al usuario autenticado
        $gasto->save();

        return redirect()->back()->with('success', 'Gasto registrado exitosamente');
    }
    public function destroy($id_Gasto)
    {
        $gasto = Gasto::where('id_Gasto', $id_Gasto)->firstOrFail();
        $gasto->delete();
        return redirect('/gastos-ingresos')->with('success', 'Gasto eliminado correctamente.');
    }

    // GastoController.php
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'monto' => 'required|numeric'
        ]);

        $gasto = Gasto::findOrFail($id);
        $gasto->update([
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'monto' => $request->monto
            
        ]);

        return response()->json(['status' => 'ok']);
    }
}





