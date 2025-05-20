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



        // Crear un nuevo gasto
        $gasto = new Gasto();
        $gasto->fecha = $request->fecha;
        $gasto->descripcion = $request->descripcion;
        $gasto->categoria = $request->categoria;
        $gasto->monto = $request->monto;
        $gasto->save();

        return redirect()->back()->with('success', 'Gasto registrado exitosamente');
    }
    public function destroy($id_Gasto)
    {
        $gasto = Gasto::where('id_Gasto', $id_Gasto)->firstOrFail();
        $gasto->delete();
        return redirect('/gastos-ingresos')->with('success', 'Gasto eliminado correctamente.');
    }
}
