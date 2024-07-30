<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCA_users extends Model
{
    protected  $table = 't_c_a_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ID_JUPITER',
        'PLATAFORMA',
        'NOMBRE',
        'CLAVE_CORTA',
        'COLABORADOR',
        'PUESTO',
        'FECHA_ALTA',
    ];
}
