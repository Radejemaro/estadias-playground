<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jupiter;

class SearchController extends Controller
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
            $result = Jupiter::whereNotNull('GID')
                ->where('GID', '!=', '')
                ->whereNotNull('NOMBRE_PC')
                ->where('NOMBRE_PC', '!=', '')
                ->get();
        } else {
            // Realiza la búsqueda en cada campo de la tabla JUPITER
            $result = DB::table('JUPITER')
                ->where(function ($query) use ($data) {
                    $query->where('GID', 'like', '%' . $data . '%')
                        ->orWhere('ID_JUPITER', 'like', '%' . $data . '%')
                        ->orWhere('NOMBRE_PC', 'like', '%' . $data . '%')
                        ->orWhere('No_SERIE', 'like', '%' . $data . '%')
                        ->orWhere('MODELO_PC', 'like', '%' . $data . '%')
                        ->orWhere('TIPO', 'like', '%' . $data . '%')
                        ->orWhere('PUESTO', 'like', '%' . $data . '%');
                })
                ->whereNotNull('GID')
                ->where('GID', '!=', '')
                ->whereNotNull('NOMBRE_PC')
                ->where('NOMBRE_PC', '!=', '')
                ->get();
        }

        return response()->json([
            "estado" => 1,
            "result" => $result
        ]);
    }
}
