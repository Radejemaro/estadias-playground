<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jupiter;

class Cat_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros donde GID y NOMBRE_PC no sean null ni vacíos
        $computers = Jupiter::whereNotNull('GID')
            ->where('GID', '!=', '')
            ->whereNotNull('NOMBRE_PC')
            ->where('NOMBRE_PC', '!=', '')
            ->get();
        return view('Categorias.Computers', compact('computers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $computer = Jupiter::findOrFail($id);
        return response()->json($computer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $computer = Jupiter::find($id);
        if ($computer) {
            return view('edit', compact('computer'));
        }
        return redirect()->route('computers.index')->with('error', 'Computadora no encontrada');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $computer = Jupiter::find($id);
        if ($computer) {
            $computer->NOMBRE_PC = $request->NOMBRE_PC;
            $computer->No_SERIE = $request->No_SERIE;
            $computer->MODELO_PC = $request->MODELO_PC;
            $computer->TIPO = $request->TIPO;
            $computer->PUESTO = $request->PUESTO;
            $computer->save();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $computer = Jupiter::find($id);
        if ($computer) {
            $computer->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }
}
