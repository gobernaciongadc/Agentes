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
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->enum('enero', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('febrero', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('marzo', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('abril', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('mayo', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('junio', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('julio', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('agosto', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('septiembre', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('octubre', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('noviembre', ['disponible', 'no disponible'])->default('disponible');
            $table->enum('diciembre', ['disponible', 'no disponible'])->default('disponible');
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict'); // Quien esta creando la sancion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos');
    }
};
