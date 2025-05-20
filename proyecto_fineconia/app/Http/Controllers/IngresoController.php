<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;

class IngresoController extends Controller
{
    public function create()
    {
        return view('ingresos.create');  // Asegúrate de que la vista exista en resources/views/gastos/create.blade.php
    }

    // Guardar el ingreso en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
        ]);

        $ingreso = new Ingreso();
        $ingreso->fecha = $request->fecha;
        $ingreso->descripcion = $request->descripcion;
        $ingreso->categoria = $request->categoria;
        $ingreso->monto = $request->monto;
        $ingreso->save();


        return redirect()->back()->with('success', 'Ingreso registrado exitosamente');
    }

    public function destroy($id_Ingreso)
    {
        $ingreso = Ingreso::where('id_Ingreso', $id_Ingreso)->firstOrFail();
        $ingreso->delete();
        return redirect('/gastos-ingresos')->with('success', 'Ingreso eliminado correctamente.');
    }
}
