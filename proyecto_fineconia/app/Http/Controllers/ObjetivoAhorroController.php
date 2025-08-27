<?php

namespace App\Http\Controllers;

use App\Models\ObjetivoAhorro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetivoAhorroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        return view('ObjetivosDeAhorro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'nombre' => 'required|string|max:100',
        'monto' => 'required|numeric|min:0.01',
        'fecha' => 'required|date|after:today'
    ]);

    ObjetivoAhorro::create([
        'usuario_id' => Auth::id(),
        'nombre_objetivo' => $validated['nombre'],
        'monto_meta' => $validated['monto'],
        'fecha_limite' => $validated['fecha']
    ]);

    return response()->json(['status' => 'ok']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ObjetivoAhorro $objetivoAhorro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ObjetivoAhorro $objetivoAhorro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ObjetivoAhorro $objetivoAhorro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ObjetivoAhorro $objetivoAhorro)
    {
        //
    }
}
