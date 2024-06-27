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
        Schema::create('JUPITER', function (Blueprint $table) {
            $table->id();
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
            $table->string('No_SERIE'); // Renombrado para evitar conflicto con el punto
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
            $table->string('SWITCHPORT_CONNECTED'); // Renombrado para corregir error tipográfico
            $table->string('RESGUARDOS_FIRMADOS');
            $table->string('USB_POLICY');
            $table->string('JUSTIFICACION'); // Renombrado para corregir error tipográfico
            $table->string('RESGUARDO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('JUPITER');
    }
};
