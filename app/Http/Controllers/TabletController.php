<?php

namespace App\Http\Controllers;

use App\Models\Tablets;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function index()
    {
        $tablets = Tablets::all();
        return view('Categorias.Tablets', compact('tablets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_JUPITER' => 'required',
        ]);

        Tablets::create($request->all());
        return redirect()->route('tablets.index');
    }

    public function edit($id)
    {
        $tablet = Tablets::findOrFail($id);
        return response()->json($tablet);
    }

    public function update(Request $request, $id)
    {
        $tablet = Tablets::findOrFail($id);
        $tablet->update($request->all());
        return redirect()->route('tablets.index');
    }

    public function destroy($id)
    {
        $tablet = Tablets::findOrFail($id);
        $tablet->delete();
        return response()->json(['success' => true]);
        return redirect()->route('tablets.index');
    }
}
