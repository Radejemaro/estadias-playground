<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TCA_users;

class TCAController extends Controller
{
    public function index()
    {
        $active_users = TCA_users::all();
        return view('Categorias.Ab&TCA_Active_Users', compact('active_users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_JUPITER' => 'required',
        ]);

        TCA_users::create($request->all());
        return redirect()->route('ab&tca_active_users.index')->with('success', 'Usuario activo agregado exitosamente');
    }

    public function edit($id)
    {
        $active_user = TCA_users::findOrFail($id);
        return response()->json($active_user);
    }

    public function update(Request $request, $id)
    {
        $active_user = TCA_users::findOrFail($id);
        $active_user->update($request->all());
        return redirect()->route('ab&tca_active_users.index')->with('success', 'Usuario activo actualizado exitosamente');
    }

    public function destroy($id)
    {
        $active_user = TCA_users::findOrFail($id);
        $active_user->delete();
        return response()->json(['success' => true]);
    }
}
