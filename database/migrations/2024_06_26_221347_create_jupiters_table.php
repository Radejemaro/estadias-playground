<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jupiters', function (Blueprint $table) {
            $table->ID();
            $table->string('GID');
            $table->string('ID_JUPITER');
            $table->string('COLEGA');
            $table->string('PUESTO');
            $table->string('DIVISION');
            $table->string('DEPTO');
            $table->string('VIP');
            $table->string('EMAIL_HYATT');
            $table->string('CONTRASENA');
            $table->string('PIN_YUBIKEY');
            $table->string('SN_YUBIKEY');
            $table->string('INTUNE');
            $table->string('COMPARTIDA');
            $table->string('NOMBRE_PC');
            $table->string('No.SERIE');
            $table->string('IP');
            $table->string('IP_WIFI');
            $table->string('DOMINIO');
            $table->string('TIPO');
            $table->string('MODELO_PC');
            $table->string('VENCIMIENTO_SOPORTE');
            $table->string('No_OS');
            $table->string('No_PRODUCTO');
            $table->string('BITS');
            $table->string('RAM');
            $table->string('DISCO_DURO');
            $table->string('PROCESADOR');
            $table->string('CUENTA_OFFICE_365');
            $table->string('ANTIVIRUS');
            $table->string('MONITOR');
            $table->string('MODELO');
            $table->string('No_SERIAL');
            $table->text('OBSERVACIONES');
            $table->string('MAC');
            $table->string('SWITCH');
            $table->string('SWIRCHPORT_CONNECTED');
            $table->string('RESGUARDOS_FIRMADOS');
            $table->string('USB_POLICY');
            $table->string('JUSTIFIACION');
            $table->string('REGUARDO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('jupiters');
    }
};
