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
        Schema::create('sancions', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_sancion');
            $table->string('motivo');
            $table->date('feha_inposicion');
            $table->decimal('monto', 10, 2);  // Aquí se usa decimal con 2 decimales
            $table->string('estado_recibido')->default('pendiente'); //validado, rechazado
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
        Schema::dropIfExists('sancions');
    }
};
