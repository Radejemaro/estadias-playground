<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tablets;

class TabletController extends Controller
{
    public function index()
    {
        $tablets = Tablets::all();
        return view('tablets', compact('tablets'));
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

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $tablet = Tablets::findOrFail($id);
        $tablet->delete();

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        // Lógica para crear un nuevo registro
    }
    public function store(Request $request)
    {
        $tablet = Tablets::create($request->all());
        return response()->json($tablet);
    }
}
