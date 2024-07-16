<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    use HasFactory;

    protected  $table = 'tablets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ID_JUPITER',
        'COLEGA',
        'CUENTA',
        'ACOUNT_PASSWORD',
        'PIN_DESBLOQUEO',
        'ESTATUS',
        'MARCA',
        'MODELO',
        'NO_SERIE',
        'MAC',
        'AREA',
        'COMENTARIOS',

    ];
}
