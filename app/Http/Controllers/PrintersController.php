<?php

namespace App\Http\Controllers;

use App\Models\Printers;
use Illuminate\Http\Request;

class PrintersController extends Controller
{
    public function index()
    {
        $printers = Printers::all();
        return view('Categorias.Printers', compact('printers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'No_SERIE' => 'required',
        ]);

        Printers::create($request->all());
        return redirect()->route('printers.index');
    }

    public function edit($id)
    {
        $printer = Printers::findOrFail($id);
        return response()->json($printer);
    }

    public function update(Request $request, $id)
    {
        $printer = Printers::findOrFail($id);
        $printer->update($request->all());
        return redirect()->route('printers.index');
    }

    public function destroy($id)
    {
        $printer = Printers::findOrFail($id);
        $printer->delete();
        return response()->json(['success' => true]);
        return redirect()->route('printers.index');
    }
}
