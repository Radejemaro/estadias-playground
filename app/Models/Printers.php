<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printers extends Model
{
    use HasFactory;

    protected  $table = 'printers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'No_SERIE',
        'IP_USB',
        'IP_HYATT',
        'MAC_ACTIVA',
        'TIPO',
        'MARCA',
        'MODELO',
        'UBICACION',
        'DEPARTAMENTO',
        'COMENTARIOS',
        'SWITCH',
        'IP_SWITCH',
        'PUERTO_SW',
    ];
}
