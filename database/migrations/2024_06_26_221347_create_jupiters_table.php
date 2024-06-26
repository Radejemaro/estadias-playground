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
            $table->id();
            $table->string('GID');
            $table->string('COLEGA');
            $table->string('PUESTO');
            $table->string('DIVISION');
            $table->string('DEPTO');
            $table->string('VIP');
            $table->string('Email_Hyatt');
            $table->string('Contraseña');
            $table->string('PIN_Yubikey');
            $table->string('SN_YUBIKEY');
            $table->string('Intune');
            $table->string('COMPARTIDA');
            $table->string('NOMBRE_PC');
            $table->string('No_Serie');
            $table->string('IP');
            $table->string('IP_WIFI');
            $table->string('DOMINIO');
            $table->string('TIPO');
            $table->string('MODELO_PC');
            $table->string('Vencimiento_Soporte');
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
            $table->string('Switch');
            $table->string('SwitchPort_Connected');
            $table->string('Resguardos_Firmados');
            $table->string('Usb_policy');
            $table->string('Justification');
            $table->string('Resguardo');
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
