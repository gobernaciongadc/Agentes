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
            $table->foreignId('tipo_sancion_id')->constrained('tipos_sancions')->onDelete('cascade');
            $table->decimal('monto', 10, 2)->default(0);
            $table->boolean('estado')->default(false); // false: pendiente, true: pagado
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sanciones');
    }
};
