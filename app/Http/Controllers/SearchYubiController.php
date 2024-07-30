<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Yubikeys;

class SearchYubiController extends Controller
{
    protected $route;

    public function __construct(Request $request)
    {
        $this->route = $request->route()->getName();
    }

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
            $result = DB::table('yubikeys')
                ->where(function ($query) use ($data) {
                    $query->where('ID_JUPITER', 'like', '%' . $data . '%')
                        ->orWhere('COLEGA', 'like', '%' . $data . '%')
                        ->orWhere('PUESTO', 'like', '%' . $data . '%')
                        ->orWhere('SN_YUBIKEY', 'like', '%' . $data . '%');
                })
                ->whereNotNull('id')
                ->where('id', '!=', '')
                ->get();
        }

        return response()->json([
            "estado" => 1,
            "result" => $result
        ]);
    }
}
