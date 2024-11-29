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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_representante_seprec');
            $table->string('nombre_razon_social');
            $table->string('numero_matricula_comercio');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('actividad');
            $table->string('nombre_representante_legal');
            $table->string('numero_cedula_identidad');
            // Archivos de la empresa
            $table->string('base_empresarial_empresas_activas');
            $table->string('transferencia_cuotas_capital');
            $table->string('transferencia_empresa_unipersonal');

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
        Schema::dropIfExists('empresas');
    }
};
