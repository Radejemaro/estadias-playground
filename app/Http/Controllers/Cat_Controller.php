<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jupiter;
use App\Models\Tablets;
use App\Models\Switchs;
use App\Models\Printers;
use App\Models\TcaActiveUsers;
use App\Models\User;

class Cat_Controller extends Controller
{
    protected $route;

    public function __construct(Request $request)
    {
        $this->route = $request->route()->getName();
    }

    public function index()
    {
        switch ($this->route) {
            case 'computers.index':
                $computers = Jupiter::whereNotNull('ID_JUPITER')
                    ->where('ID_JUPITER', '!=', '')
                    ->whereNotNull('NOMBRE_PC')
                    ->where('NOMBRE_PC', '!=', '')
                    ->get();
                return view('Categorias.Computers', compact('computers'));
            case 'tablets.index':
                $tablets = Tablets::whereNotNull('id')
                    ->where('id', '!=', '')
                    ->whereNotNull('NO_SERIE')
                    ->where('NO_SERIE', '!=', '')
                    ->get();
                return view('Categorias.Tablets', compact('tablets'));
            case 'yubikeys.index':
                $yubikeys = Jupiter::whereNotNull('ID_JUPITER')
                    ->where('ID_JUPITER', '!=', '')
                    ->whereNotNull('SN_YUBIKEY')
                    ->where('SN_YUBIKEY', '!=', '')
                    ->whereNotNull('PUESTO')
                    ->where('PUESTO', '!=', '')
                    ->whereNotNull('COLEGA')
                    ->where('COLEGA', '!=', '')
                    ->get();
                return view('Categorias.YubiKeys', compact('yubikeys'));
            case 'switches.index':
                $switches = Jupiter::whereNotNull('ID_JUPITER')
                    ->where('ID_JUPITER', '!=', '')
                    ->whereNotNull('NOMBRE_PC')
                    ->where('NOMBRE_PC', '!=', '')
                    ->get();
                return view('Categorias.Switches', compact('switches'));
            case 'printers.index':
                $printers = Printers::whereNotNull('id')
                    ->where('id', '!=', '')
                    ->where('TIPO', '!=', 'DISPONIBLE')
                    ->where('TIPO', '!=', '')
                    ->get();
                return view('Categorias.Printers', compact('printers'));
            case 'ab&tca_active_users.index':
                $active_users = Jupiter::whereNotNull('ID_JUPITER')
                    ->where('ID_JUPITER', '!=', '')
                    ->whereNotNull('NOMBRE_PC')
                    ->where('NOMBRE_PC', '!=', '')
                    ->get();
                return view('Categorias.Ab&TCA_Active_Users', compact('active_users'));
            default:
                return view('Index');
        }
    }

    public function create()
    {
        switch ($this->route) {
            case 'computers.create':
                return view('Categorias.create');
            case 'tablets.create':
                return view('Categorias.createTablet');
            case 'yubikeys.create':
                return view('Categorias.create');
            case 'switches.create':
                return view('Categorias.create');
            case 'printers.create':
                return view('Categorias.create');
            case 'ab&tca_active_users.create':
                return view('Categorias.create');
            default:
                return view('Index');
        }
    }

    public function store(Request $request)
    {
        switch ($this->route) {
            case 'computers.create':
                $jupiter = new Jupiter();
                $jupiter->fill($request->all());
                $jupiter->save();
                break;
            case 'tablets.create':
                $tablet = new Tablets();
                $tablet->fill($request->all());
                $tablet->save();
                break;
            case 'yubikeys.create':
                $yubikey = new Jupiter();
                $yubikey->fill($request->all());
                $yubikey->save();
                break;
            case 'switches.create':
                $switch = new Jupiter();
                $switch->fill($request->all());
                $switch->save();
                break;
            case 'ab&tca_active_users.create':
                $active_user = new Jupiter();
                $active_user->fill($request->all());
                $active_user->save();
                break;
            case 'printers.create':
                $printer = new Printers();
                $printer->No_SERIE = $request->No_SERIE;
                $printer->IP_USB = $request->IP_USB;
                $printer->MAC_ACTIVA = $request->MAC_ACTIVA;
                $printer->TIPO = $request->TIPO;
                $printer->MARCA = $request->MARCA;
                $printer->UBICACION = $request->UBICACION;
                $printer->DEPARTAMENTO = $request->DEPARTAMENTO;
                $printer->save();

                return response()->json(['success' => 'Impresora agregada correctamente']);
                break;
            default:
                return view('Index');
        }
        return response()->json(['status' => 'success']);
    }

    public function show(Request $request, string $id)
    {
        $jupiter = Jupiter::findOrFail($id);
        return response()->json($jupiter);
        if ($id) {
        $printer = Printers::find($id);
        return response()->json($printer);
    } elseif ($request->has('search_term')) {
        $searchTerm = $request->input('search_term');
        $printers = Printers::where('No_SERIE', 'LIKE', "%$searchTerm%")
            ->orWhere('IP_USB', 'LIKE', "%$searchTerm%")
            ->orWhere('MAC_ACTIVA', 'LIKE', "%$searchTerm%")
            ->orWhere('TIPO', 'LIKE', "%$searchTerm%")
            ->orWhere('MARCA', 'LIKE', "%$searchTerm%")
            ->orWhere('UBICACION', 'LIKE', "%$searchTerm%")
            ->orWhere('DEPARTAMENTO', 'LIKE', "%$searchTerm%")
            ->get();
        return response()->json($printers);
    };
    }

    public function edit(string $id)
    {
        switch ($this->route) {
            case 'computers.edit':
                $computer = Jupiter::find($id);
                if ($computer) {
                    return view('edit', compact('computer'));
                }
                return redirect()->route('computers.index')->with('error', 'Computadora no encontrada');
            case 'tablets.edit':
                $tablet = Tablets::find($id);
                if ($tablet) {
                    return view('edit', compact('tablet'));
                }
                return redirect()->route('tablets.index')->with('error', 'Tablet no encontrada');
            case 'yubikeys.edit':
                $yubikey = Jupiter::find($id);
                if ($yubikey) {
                    return view('edit', compact('yubikey'));
                }
                return redirect()->route('yubikeys.index')->with('error', 'Yubikey no encontrada');
            case 'printers.edit':
                $printer = Printers::find($id);
                if ($printer) {
                    return view('edit', compact('printer'));
                }
                return redirect()->route('printers.index')->with('error', 'Impresora no encontrada');
        }
    }

    public function update(Request $request, string $id)
    {
        switch ($this->route) {
            case 'computers.update':
                $computer = Jupiter::findOrFail($id);
                $computer->NOMBRE_PC = $request->NOMBRE_PC;
                $computer->No_SERIE = $request->No_SERIE;
                $computer->MODELO_PC = $request->MODELO_PC;
                $computer->TIPO = $request->TIPO;
                $computer->PUESTO = $request->PUESTO;
                $computer->save();
                return response()->json(['status' => 'success']);
            case 'tablets.update':
                $tablet = Tablets::findOrFail($id);
                $tablet->COLEGA = $request->COLEGA;
                $tablet->CUENTA = $request->CUENTA;
                $tablet->ACOUNT_PASSWORD = $request->ACOUNT_PASSWORD;
                $tablet->PIN_DESBLOQUEO = $request->PIN_DESBLOQUEO;
                $tablet->MARCA = $request->MARCA;
                $tablet->MODELO = $request->MODELO;
                $tablet->AREA = $request->AREA;
                if ($tablet->save()) {
                    return response()->json(['status' => 'success']);
                } else {
                    return response()->json(['status' => 'error']);
                }
            case 'yubikeys.update':
                $yubikey = Jupiter::findOrFail($id);
                $yubikey->COLEGA = $request->COLEGA;
                $yubikey->PUESTO = $request->PUESTO;
                $yubikey->SN_YUBIKEY = $request->SN_YUBIKEY;
                $yubikey->PIN_YUBIKEY = $request->PIN_YUBIKEY;
                $yubikey->save();
                return response()->json(['status' => 'success']);
            case 'printers.update':
                $printer = Printers::find($id);
                $printer->No_SERIE = $request->No_SERIE;
                $printer->IP_USB = $request->IP_USB;
                $printer->MAC_ACTIVA = $request->MAC_ACTIVA;
                $printer->TIPO = $request->TIPO;
                $printer->MARCA = $request->MARCA;
                $printer->UBICACION = $request->UBICACION;
                $printer->DEPARTAMENTO = $request->DEPARTAMENTO;
                $printer->save();

                return response()->json(['success' => 'Impresora actualizada correctamente']);
        }
        return response()->json(['status' => 'error'], 404);
    }

    public function destroy(string $id)
    {
        switch ($this->route) {
            case 'computers.destroy':
                $computer = Jupiter::findOrFail($id);
                if ($computer) {
                    $computer->delete();
                    return response()->json(['status' => 'success']);
                }
                return response()->json(['status' => 'error'], 404);
            case 'tablets.destroy':
                $tablet = Tablets::findOrFail($id);
                if ($tablet) {
                    $tablet->delete();
                    return response()->json(['status' => 'success']);
                }
                return response()->json(['status' => 'error'], 404);
            case 'yubikeys.destroy':
                $yubikey = Jupiter::findOrFail($id);
                if ($yubikey) {
                    $yubikey->delete();
                    return response()->json(['status' => 'success']);
                }
                return response()->json(['status' => 'error'], 404);
            case 'printers.destroy':
                $printer = Printers::findOrFail($id);
                if ($printer) {
                    $printer->delete();
                    return response()->json(['status' => 'success']);
                }
                return response()->json(['status' => 'error'], 404);
        }
    }

}
