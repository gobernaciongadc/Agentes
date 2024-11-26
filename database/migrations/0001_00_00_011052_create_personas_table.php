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
        Schema::create('personas', function (Blueprint $table) {

            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('carnet', 20)->unique();
            $table->string('correo_electronico', 100)->unique()->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->integer('estado_user')->default(1);
            $table->integer('estado_agente')->default(1);

            // Campos de timestamps
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
