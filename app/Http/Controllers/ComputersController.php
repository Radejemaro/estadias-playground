<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jupiter;

class ComputersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $computers = Jupiter::all();
        return view('Categorias.Computers', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_JUPITER'=>'required',
        ]);
        Jupiter::create($request->all());
        return redirect()->route('Computers.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $computers = Jupiter::find($id);
        return response()->json($computers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $computers = Jupiter::find($id);
        $computers->update($request->all());
        return redirect()->route('Computers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $computers = Jupiter::find($id);
        $computers->delete();
        return response()->json(['success'=>true]);
        return redirect()->route('Computers.index');
    }
}
