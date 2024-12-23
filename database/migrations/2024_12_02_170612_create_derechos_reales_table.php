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
        Schema::create('derechos_reales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_registrador');
            $table->string('municipio_jurisdiccion');
            $table->string('naturaleza_titulo');
            $table->string('numero_titulo');
            $table->string('nombre_razon_social_cedente');
            $table->string('cedula_o_nit_cedente');
            $table->string('nombre_razon_social_beneficiario');
            $table->string('cedula_o_nit_beneficiario');
            $table->string('superficie_del_inmueble');
            $table->string('porcentaje_de_acciones');
            $table->string('tipo_de_formulario');
            $table->string('numero_de_orden');
            $table->decimal('monto_pagado', 10, 2);
            $table->timestamps();

            // Datos relacionados con el informe a URE
            $table->foreignId('informe_id')->constrained('informe_notarials')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derechos_reales');
    }
};
