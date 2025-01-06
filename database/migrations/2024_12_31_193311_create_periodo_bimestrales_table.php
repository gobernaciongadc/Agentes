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
        Schema::create('periodo_bimestrales', function (Blueprint $table) {
            $table->id();
            $table->string('year');

            $table->enum('enero_febrero', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('marzo_abril', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('mayo_junio', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('julio_agosto', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('septiembre_octubre', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('noviembre_diciembre', ['disponible', 'no disponible'])->default('disponible');

            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict'); // Quien esta creando la sancion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos_bimestrales');
    }
};
