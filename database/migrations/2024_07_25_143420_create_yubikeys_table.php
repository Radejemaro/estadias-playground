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
        Schema::create('yubikeys', function (Blueprint $table) {
            $table->id();
            $table->string('ID_JUPITER');
            $table->string('COLEGA');
            $table->string('PUESTO');
            $table->string('SN_YUBIKEY');
            $table->string('PIN_YUBIKEY');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yubikeys');
    }
};
