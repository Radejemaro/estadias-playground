<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Printers;

class SearchPrinterController extends Controller
{
    public function searchPrinters(Request $request)
    {
        $valor = $request->get('valor');

        $printers = Printers::where('No_SERIE', 'LIKE', "%{$valor}%")
            ->orWhere('IP_USB', 'LIKE', "%{$valor}%")
            ->orWhere('MAC_ACTIVA', 'LIKE', "%{$valor}%")
            ->orWhere('TIPO', 'LIKE', "%{$valor}%")
            ->orWhere('MARCA', 'LIKE', "%{$valor}%")
            ->orWhere('UBICACION', 'LIKE', "%{$valor}%")
            ->orWhere('DEPARTAMENTO', 'LIKE', "%{$valor}%")
            ->get();

        if ($printers->isEmpty()) {
            return response()->json(['estado' => 0, 'message' => 'No se encontraron resultados']);
        }

        return response()->json(['estado' => 1, 'result' => $printers]);
    }
}
