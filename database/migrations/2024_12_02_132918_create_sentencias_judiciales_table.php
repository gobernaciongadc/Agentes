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
        Schema::create('sentencias_judiciales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_secretario');
            $table->string('numero_juzgado');
            $table->string('municipio_jurisdiccion');
            $table->string('naturaleza_proceso');
            $table->string('numero_resolucion');
            $table->string('fecha_resolucion');
            $table->string('nombre_demandante');
            $table->string('cedula_demandante');
            $table->string('nombre_demandado');
            $table->string('cedula_demandado');
            // Datos relacionados con el informe a URE
            $table->foreignId('informe_id')->constrained('informe_notarials')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentencias_judiciales');
    }
};
