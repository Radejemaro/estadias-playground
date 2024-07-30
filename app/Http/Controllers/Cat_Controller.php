<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jupiter;
use App\Models\Tablets;
use App\Models\Yubikeys;
use App\Models\Printers;
use App\Models\TCA_users;
use App\Models\Switches;

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
                return $this->computersIndex();
            case 'tablets.index':
                return $this->tabletsIndex();
            case 'yubikeys.index':
                return $this->yubikeysIndex();
            case 'switches.index':
                return $this->switchesIndex();
            case 'printers.index':
                return $this->printersIndex();
            case 'ab&tca_active_users.index':
                return $this->activeUsersIndex();
            default:
                return view('Index');
        }
    }

    private function computersIndex()
    {
        $computers = Jupiter::whereNotNull('ID_JUPITER')
            ->where('ID_JUPITER', '!=', '')
            ->whereNotNull('NOMBRE_PC')
            ->where('NOMBRE_PC', '!=', '')
            ->get();
        return view('Categorias.Computers', compact('computers'));
    }

    private function tabletsIndex()
    {
        $tablets = Tablets::whereNotNull('id')
            ->where('id', '!=', '')
            ->whereNotNull('NO_SERIE')
            ->where('NO_SERIE', '!=', '')
            ->get();
        return view('Categorias.Tablets', compact('tablets'));
    }

    private function yubikeysIndex()
    {
        $yubikeys = Yubikeys::whereNotNull('ID_JUPITER')
            ->where('ID_JUPITER', '!=', '')
            ->whereNotNull('SN_YUBIKEY')
            ->where('SN_YUBIKEY', '!=', '')
            ->whereNotNull('PUESTO')
            ->where('PUESTO', '!=', '')
            ->whereNotNull('COLEGA')
            ->where('COLEGA', '!=', '')
            ->get();
        return view('Categorias.YubiKeys', compact('yubikeys'));
    }

    private function switchesIndex()
    {
        $switches = Switches::whereNotNull('IP')
            ->where('IP', '!=', '')
            ->get();
        return view('Categorias.Switches', compact('switches'));
    }

    private function printersIndex()
    {
        $printers = Printers::whereNotNull('id')
            ->where('id', '!=', '')
            ->where('TIPO', '!=', 'DISPONIBLE')
            ->where('TIPO', '!=', '')
            ->get();
        return view('Categorias.Printers', compact('printers'));
    }

    private function activeUsersIndex()
    {
        $active_users = TCA_users::whereNotNull('ID_JUPITER')
            ->where('ID_JUPITER', '!=', '')
            ->whereNotNull('NOMBRE')
            ->where('NOMBRE', '!=', '')
            ->get();
        return view('Categorias.Ab&TCA_Active_Users', compact('active_users'));
    }
}
