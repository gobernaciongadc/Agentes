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
        Schema::create('notary_records', function (Blueprint $table) {
            $table->id();
            $table->string('municipio'); // Texto
            $table->string('numero_notaria'); // Alfanumérico
            $table->string('nombre_notaria'); // Texto
            $table->string('numero_escritura'); // Alfanumérico
            $table->date('fecha_escritura'); // Fecha (Numérico)
            $table->string('naturaleza_escritura'); // Alfanumérico
            $table->string('nombre_cedente'); // Texto
            $table->string('ci_nit_cedente'); // Alfanumérico
            $table->string('nombre_beneficiario'); // Texto
            $table->string('ci_nit_beneficiario'); // Alfanumérico
            $table->string('tipo_bien'); // Texto
            $table->string('registro_bien')->nullable(); // Alfanumérico, puede ser nulo
            $table->string('tipo_formulario')->nullable(); // Alfanumérico, puede ser nulo
            $table->unsignedBigInteger('numero_orden'); // Numérico
            $table->decimal('monto_pagado', 15, 2); // Numérico con dos decimales
            $table->text('observaciones')->nullable(); // Alfanumérico, puede ser nulo
            $table->foreignId('informe_id')->constrained('informe_notarials')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps(); // Crea las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notary_records');
    }
};
