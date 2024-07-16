<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tablets', function (Blueprint $table) {
            $table->id();
            $table->string('ID_JUPITER');
            $table->string('COLEGA');
            $table->string('CUENTA');
            $table->string('ACOUNT_PASSWORD');
            $table->string('PIN_DESBLOQUEO');
            $table->string('ESTATUS');
            $table->string('MARCA');
            $table->string('MODELO');
            $table->string('NO_SERIE');
            $table->string('MAC');
            $table->string('AREA');
            $table->string('COMENTARIOS');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablets');
    }
};
