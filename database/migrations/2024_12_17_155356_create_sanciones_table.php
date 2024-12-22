<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sanciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('monto', 255);
            $table->enum('estado', ['Pendiente', 'Pagado'])->default('Pendiente'); // Estado del pago
            $table->enum('estado_vista', ['Revizado', 'No revizado'])->default('No revizado'); // Estado del pago
            $table->enum('estado_envio', ['Enviado', 'No enviado'])->default('No enviado'); // Estado del pago
            $table->foreignId('agente_id')->constrained('agentes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict'); // Quien esta creando la sancion
            $table->foreignId('informe_id')->constrained('informe_notarials')->onUpdate('cascade')->onDelete('restrict'); // Para que informe es la sancion
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sanciones');
    }
};
