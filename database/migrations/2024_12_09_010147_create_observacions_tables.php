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
        Schema::create('observacions', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion')->nullable();
            $table->string('archivo_observacion')->nullable();
            $table->string('tipo_informe')->nullable();
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('informe_id')->constrained('informe_notarials')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observacion_tables');
    }
};
