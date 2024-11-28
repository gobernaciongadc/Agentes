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

        Schema::create('informe_notarials', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->text('descripcion'); // Descripción del informe
            $table->enum('estado', ['verificado', 'no verificado'])->default('no verificado'); // Estado del informe
            $table->timestamp('fecha_envio'); // Fecha y hora de envío
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe_notarials');
    }
};
