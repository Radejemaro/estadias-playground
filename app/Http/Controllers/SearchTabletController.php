<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tablets;

class SearchTabletController extends Controller
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
            $result = Tablets::whereNotNull('id')
                ->where('id', '!=', '')
                ->whereNotNull('NO_SERIE')
                ->where('NO_SERIE', '!=', '')
                ->get();
        } else {
            // Realiza la búsqueda en cada campo de la tabla Tablets
            $result = DB::table('Tablets')
                ->where(function ($query) use ($data) {
                    $query->where('id', 'like', '%' . $data . '%')
                        ->orWhere('NO_SERIE', 'like', '%' . $data . '%')
                        ->orWhere('MARCA', 'like', '%' . $data . '%')
                        ->orWhere('MODELO', 'like', '%' . $data . '%')
                        ->orWhere('TIPO', 'like', '%' . $data . '%')
                        ->orWhere('PUESTO', 'like', '%' . $data . '%');
                })
                ->whereNotNull('id')
                ->where('id', '!=', '')
                ->whereNotNull('NO_SERIE')
                ->where('NO_SERIE', '!=', '')
                ->get();
        }

        return response()->json([
            "estado" => 1,
            "result" => $result
        ]);
    }
}
