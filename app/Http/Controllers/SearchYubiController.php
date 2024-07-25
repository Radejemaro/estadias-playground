<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yubikeys;

class SearchYubiController extends Controller
{
    public function show(Request $request)
    {
        $data = trim($request->input('valor', ''));

        if ($data === '') {
            // Si el input está vacío, devuelve la consulta por defecto (todos los registros)
            $result = Yubikeys::whereNotNull('id')
                ->where('id', '!=', '')
                ->get();
        } else {
            // Realiza la búsqueda en cada campo de la tabla yubikeys
            $result = Yubikeys::where(function ($query) use ($data) {
                $query->where('ID_JUPITER', 'like', '%' . $data . '%')
                    ->orWhere('COLEGA', 'like', '%' . $data . '%')
                    ->orWhere('PUESTO', 'like', '%' . $data . '%')
                    ->orWhere('SN_YUBIKEY', 'like', '%' . $data . '%')
                    ->orWhere('PIN_YUBIKEY', 'like', '%' . $data . '%');
            })
                ->get(['ID_JUPITER', 'COLEGA', 'PUESTO', 'SN_YUBIKEY', 'PIN_YUBIKEY']);
        }

        return view('yubikeys.index', ['result' => $result]);
    }
}
