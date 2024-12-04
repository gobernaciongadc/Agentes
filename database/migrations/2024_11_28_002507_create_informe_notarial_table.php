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
            $table->enum('estado', ['Pendiente', 'Verificado', 'No verificado'])->default('Pendiente'); // Estado del informe
            $table->timestamp('fecha_envio')->nullable(); // Fecha y hora de envío
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
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
