<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yubikeys extends Model
{
    use HasFactory;

    protected $table = 'yubikeys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ID_JUPITER',
        'COLEGA',
        'PUESTO',
        'SN_YUBIKEY',
        'PIN_YUBIKEY'];
}
