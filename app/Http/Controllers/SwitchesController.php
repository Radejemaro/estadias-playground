<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Switches;

class SwitchesController extends Controller
{

    public function index()
    {
        $switches = Switches::all();
        return view('Categorias.Switches', compact('switches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'IP' => 'required',
        ]);
        Switches::create($request->all());
        return redirect()->route('switches.index');
    }

    public function edit($id)
    {
        $switches = Switches::findOrFail($id);
        return response()->json($switches);
    }

    public function update(Request $request, string $id)
    {
        $switches = Switches::findOrFail($id);
        $switches->update($request->all());
        return redirect()->route('switches.index');
    }

    public function destroy(string $id)
    {
        $switches = Switches::findOrFail($id);
        $switches->delete();
        return response()->json(['success' => true]);
        return redirect()->route('switches.index');
    }
}
