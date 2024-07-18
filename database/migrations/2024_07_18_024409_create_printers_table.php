<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printers', function (Blueprint $table) {
            $table->id();
            $table->string('No_SERIE', 512);
            $table->string('IP_USB', 512);
            $table->string('IP_HYATT', 512);
            $table->string('MAC_ACTIVA', 512);
            $table->string('TIPO', 512);
            $table->string('MARCA', 512);
            $table->string('MODELO', 512);
            $table->string('UBICACION', 512);
            $table->string('DEPARTAMENTO', 512);
            $table->string('COMENTARIOS', 512)->nullable();
            $table->string('SWITCH', 512);
            $table->string('IP_SWITCH', 512);
            $table->string('PUERTO_SW', 512);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printers');
    }
}
