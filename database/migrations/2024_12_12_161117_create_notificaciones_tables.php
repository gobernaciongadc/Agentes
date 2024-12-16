<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id(); // ID del comunicado
            $table->string('asunto'); // Resumen del propósito
            $table->string('destinatario'); // Destinatarios (puede ser un grupo o tipo de agente)
            $table->text('mensaje'); // Cuerpo del mensaje
            $table->date('fecha_emision'); // Fecha de emisión
            $table->string('adjuntos')->nullable(); // Archivos adjuntos (ruta de almacenamiento)
            $table->enum('estado', ['Revizado', 'No revizado'])->default('No revizado'); // Estado Notificacion
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunicados');
    }
};
