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
            $table->text('descripcion', 800); // Descripción del informe

            $table->string('year', 800); // Descripción del informe
            $table->string('periodo', 800); // Descripción del informe

            $table->date('periodo_date', 800); // Descripción del informe
            $table->integer('dias_retrazo')->nullable(); // Dias con retrazo

            $table->enum('estado', ['Pendiente', 'Verificado', 'No verificado', 'Rechazado', 'Corregido'])->default('Pendiente'); // Estado del informe
            $table->enum('estado_sancion', ['Sin sancion', 'Con sancion'])->default('Sin sancion'); // Estado del informe

            $table->enum('envio_agente', ['Enviado', 'No enviado'])->default('No enviado'); // 
            $table->enum('envio_gober', ['Enviado', 'No enviado'])->default('No enviado'); // 
            $table->enum('estado_vista', ['Revizado', 'No revizado'])->default('No revizado'); // 

            $table->enum('estado_plazo_sancion', ['Sin crear', 'creado', 'enviado'])->default('Sin crear'); // Estado del informe


            $table->timestamp('fecha_envio')->nullable(); // Fecha y hora de envío
            $table->string('tipo_informe')->nullable(); // Tipo de informe
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
