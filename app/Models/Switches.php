<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Switches extends Model
{
    use HasFactory;

    protected  $table = 'switches';
    protected $primaryKey = 'id';
    protected $fillable = [
        'MARCA',
        'MODELO',
        'IP',
        'OLD_IP',
        'NAME',
        'OLD_NAME',
        'UBICACION',
        'MARCA_UPS',
        'MODELO_UPS',
    ];
}
