<?php

namespace App\Http\Controllers;

use App\Models\YubiKeys;
use Illuminate\Http\Request;

class YubiKeyController extends Controller
{
    public function index()
    {
        $yubikeys = YubiKeys::all();
        return view('Categorias.YubiKeys', compact('yubikeys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_JUPITER' => 'required',
        ]);

        YubiKeys::create($request->all());
        return redirect()->route('yubikeys.index');
    }

    public function edit($id)
    {
        $yubikey = YubiKeys::findOrFail($id);
        return response()->json($yubikey);
    }

    public function update(Request $request, $id)
    {
        $yubikey = YubiKeys::findOrFail($id);
        $yubikey->update($request->all());
        return redirect()->route('yubikeys.index');
    }

    public function destroy($id)
    {
        $yubikey = YubiKeys::findOrFail($id);
        $yubikey->delete();
        return response()->json(['success' => true]);
        return redirect()->route('yubikeys.index');
    }
}
