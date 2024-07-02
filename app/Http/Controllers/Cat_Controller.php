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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
