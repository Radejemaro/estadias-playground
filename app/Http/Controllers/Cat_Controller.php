<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jupiter;
use App\Models\Tablets;

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
                $computers = Jupiter::whereNotNull('GID')
                    ->where('GID', '!=', '')
                    ->whereNotNull('NOMBRE_PC')
                    ->where('NOMBRE_PC', '!=', '')
                    ->get();
                return view('Categorias.Computers', compact('computers'));
            case 'tablets.index':
                $tablets = Tablets::whereNotNull('GID')
                    ->where('GID', '!=', '')
                    ->whereNotNull('NOMBRE_PC')
                    ->where('NOMBRE_PC', '!=', '')
                    ->get();
                return view('Categorias.Tablets', compact('tablets'));
            case 'yubikeys.index':
                $yubikeys = Jupiter::whereNotNull('GID')
                    ->where('GID', '!=', '')
                    ->whereNotNull('SN_YUBIKEY')
                    ->where('SN_YUBIKEY', '!=', '')
                    ->whereNotNull('PUESTO')
                    ->where('PUESTO', '!=', '')
                    ->whereNotNull('COLEGA')
                    ->where('COLEGA', '!=', '')
                    ->get();
                return view('Categorias.YubiKeys', compact('yubikeys'));
            case 'switches.index':
                $switches = Jupiter::whereNotNull('GID')
                    ->where('GID', '!=', '')
                    ->whereNotNull('NOMBRE_PC')
                    ->where('NOMBRE_PC', '!=', '')
                    ->get();
                return view('Categorias.Switches', compact('switches'));
            case 'printers.index':
                $printers = Jupiter::whereNotNull('GID')
                    ->where('GID', '!=', '')
                    ->whereNotNull('NOMBRE_PC')
                    ->where('NOMBRE_PC', '!=', '')
                    ->get();
                return view('Categorias.Printers', compact('printers'));
            case 'ab&tca_active_users.index':
                $active_users = Jupiter::whereNotNull('GID')
                    ->where('GID', '!=', '')
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
        return view('Categorias.create');
    }

    public function store(Request $request)
    {
        $jupiter = new Jupiter();
        $jupiter->GID = $request->input('GID');
        $jupiter->ID_JUPITER = $request->input('ID_JUPITER');
        $jupiter->COLEGA = $request->input('COLEGA');
        $jupiter->PUESTO = $request->input('PUESTO');
        $jupiter->DIVISION = $request->input('DIVISION');
        $jupiter->DEPTO = $request->input('DEPTO');
        $jupiter->VIP = $request->input('VIP');
        $jupiter->EMAIL_HYATT = $request->input('EMAIL_HYATT');
        $jupiter->CONTRASENA = $request->input('CONTRASENA');
        $jupiter->PIN_YUBIKEY = $request->input('PIN_YUBIKEY');
        $jupiter->SN_YUBIKEY = $request->input('SN_YUBIKEY');
        $jupiter->INTUNE = $request->input('INTUNE');
        $jupiter->COMPARTIDA = $request->input('COMPARTIDA');
        $jupiter->NOMBRE_PC = $request->input('NOMBRE_PC');
        $jupiter->No_SERIE = $request->input('No_SERIE');
        $jupiter->IP = $request->input('IP');
        $jupiter->IP_WIFI = $request->input('IP_WIFI');
        $jupiter->TIPO = $request->input('TIPO');
        $jupiter->MODELO_PC = $request->input('MODELO_PC');
        $jupiter->VENCIMIENTO_SOPORTE = $request->input('VENCIMIENTO_SOPORTE');
        $jupiter->No_OS = $request->input('No_OS');
        $jupiter->No_PRODUCTO = $request->input('No_PRODUCTO');
        $jupiter->BITS = $request->input('BITS');
        $jupiter->RAM = $request->input('RAM');
        $jupiter->DISCO_DURO = $request->input('DISCO_DURO');
        $jupiter->PROCESADOR = $request->input('PROCESADOR');
        $jupiter->CUENTA_OFFICE_365 = $request->input('CUENTA_OFFICE_365');
        $jupiter->ANTIVIRUS = $request->input('ANTIVIRUS');
        $jupiter->MONITOR = $request->input('MONITOR');
        $jupiter->MODELO = $request->input('MODELO');
        $jupiter->No_SERIAL = $request->input('No_SERIAL');
        $jupiter->OBSERVACIONES = $request->input('OBSERVACIONES');
        $jupiter->MAC = $request->input('MAC');
        $jupiter->SWITCH = $request->input('SWITCH');
        $jupiter->SWITCHPORT_CONNECTED = $request->input('SWITCHPORT_CONNECTED');
        $jupiter->RESGUARDOS_FIRMADOS = $request->input('RESGUARDOS_FIRMADOS');
        $jupiter->USB_POLICY = $request->input('USB_POLICY');
        $jupiter->JUSTIFICACION = $request->input('JUSTIFICACION');
        $jupiter->RESGUARDO = $request->input('RESGUARDO');
        $jupiter->save();

        return response()->json(['status' => 'success']);
    }

    public function show(string $id)
    {
        $jupiter = Jupiter::findOrFail($id);
        return response()->json($jupiter);
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
                return redirect()->route('tablets.index')->with('error', 'Tablet no encontrado');
            case 'yubikeys.edit':
                $yubikey = Jupiter::find($id);
                if ($yubikey) {
                    return view('edit', compact('yubikey'));
                }
                return redirect()->route('yubikeys.index')->with('error', 'Yubikey no encontrada');
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
                $tablet->NOMBRE_PC = $request->NOMBRE_PC;
                $tablet->No_SERIE = $request->No_SERIE;
                $tablet->MODELO_PC = $request->MODELO_PC;
                $tablet->TIPO = $request->TIPO;
                $tablet->PUESTO = $request->PUESTO;
                $tablet->save();
                return response()->json(['status' => 'success']);
            case 'yubikeys.update':
                $yubikey = Jupiter::findOrFail($id);
                $yubikey->COLEGA = $request->COLEGA;
                $yubikey->PUESTO = $request->PUESTO;
                $yubikey->SN_YUBIKEY = $request->SN_YUBIKEY;
                $yubikey->PIN_YUBIKEY = $request->PIN_YUBIKEY;
                $yubikey->save();
                return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }

    public function destroy(string $id)
    {
        $jupiter = Jupiter::findOrFail($id);
        if ($jupiter) {
            $jupiter->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }
}
