<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jupiter extends Model
{
    use HasFactory;

    protected  $table = 'JUPITER';
    protected $primaryKey = 'id';
    protected $fillable = [
        'GID',
        'ID_JUPITER',
        'COLEGA',
        'PUESTO',
        'DIVISION',
        'DEPTO',
        'VIP',
        'EMAIL_HYATT',
        'CONTRASENA',
        'PIN_YUBIKEY',
        'SN_YUBIKEY',
        'INTUNE',
        'COMPARTIDA',
        'NOMBRE_PC',
        'No_SERIE',
        'IP',
        'IP_WIFI',
        'DOMINIO',
        'TIPO',
        'MODELO_PC',
        'VENCIMIENTO_SOPORTE',
        'No_OS',
        'No_PRODUCTO',
        'BITS',
        'RAM',
        'DISCO_DURO',
        'PROCESADOR',
        'CUENTA_OFFICE_365',
        'ANTIVIRUS',
        'MONITOR',
        'MODELO',
        'No_SERIAL',
        'OBSERVACIONES',
        'MAC',
        'SWITCH',
        'SWITCHPORT_CONNECTED',
        'RESGUARDOS_FIRMADOS',
        'USB_POLICY',
        'JUSTIFICACION',
        'RESGUARDO',
    ];
}
