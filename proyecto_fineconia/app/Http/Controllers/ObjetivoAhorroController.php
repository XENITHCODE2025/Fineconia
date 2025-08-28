<?php

namespace App\Http\Controllers;

use App\Models\ObjetivoAhorro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetivoAhorroController extends Controller
{
    public function create()
    {
        return view('ObjetivosDeAhorro');
    }
    public function indexMostrar()
    {
       

    $objetivos = ObjetivoAhorro::where('user_id', auth()->id())->get();

    return view('Ahorro', compact('objetivos'));

    }
    
    // ✅ Registrar un nuevo objetivo
     public function index()
    {
        $objetivos = ObjetivoAhorro::where('user_id', Auth::id())->get();

        return response()->json($objetivos);
    }
    public function store(Request $request)
{
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

    return redirect()->route('objetivos.nuevo')->with('success', 'Objetivo creado con éxito');
}

public function update(Request $request, $id)
{
    $objetivo = ObjetivoAhorro::where('user_id', Auth::id())->findOrFail($id);

    $request->validate([
        'nombre'      => 'required|string|max:255',
        'monto'       => 'required|numeric|min:1',
        'fecha_desde' => 'required|date',
        'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
    ]);

    $objetivo->update($request->only(['nombre', 'monto', 'fecha_desde', 'fecha_hasta']));

    return response()->json([
        'message'  => 'Objetivo actualizado con éxito',
        'objetivo' => $objetivo,
    ]);
}


    // ✅ Eliminar un objetivo
    public function destroy($id)
    {
        $objetivo = ObjetivoAhorro::where('user_id', Auth::id())->findOrFail($id);
        $objetivo->delete();

        return response()->json([
            'message' => 'Objetivo eliminado con éxito'
        ]);
    }
}
