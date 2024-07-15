<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jupiter;

class SearchYubiController extends Controller
{
    public function show(Request $request)
    {
        $data = trim($request->input('valor', ''));

        if ($data === '') {
            // Si el input está vacío, devuelve la consulta por defecto (todos los registros)
            $result = Jupiter::whereNotNull('GID')
                ->where('GID', '!=', '')
                ->get(['GID', 'ID_JUPITER', 'COLEGA', 'PUESTO', 'SN_YUBIKEY']);
        } else {
            // Realiza la búsqueda en cada campo de la tabla JUPITER
            $result = DB::table('JUPITER')
                ->where(function ($query) use ($data) {
                    $query->where('GID', 'like', '%' . $data . '%')
                        ->orWhere('ID_JUPITER', 'like', '%' . $data . '%')
                        ->orWhere('COLEGA', 'like', '%' . $data . '%')
                        ->orWhere('PUESTO', 'like', '%' . $data . '%')
                        ->orWhere('SN_YUBIKEY', 'like', '%' . $data . '%');
                })
                ->whereNotNull('GID')
                ->where('GID', '!=', '')
                ->get(['GID', 'ID_JUPITER', 'COLEGA', 'PUESTO', 'SN_YUBIKEY']);
        }

        return response()->json([
            "estado" => 1,
            "result" => $result
        ]);
    }
}
