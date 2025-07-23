<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reporte_fallas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('instructor_id');
            $table->text('descripcion');
            $table->string('estado')->default('pendiente'); // pendiente/revisado/solucionado
            $table->timestamps();

            $table->foreign('vehiculo_id')
                  ->references('id')->on('vehiculo')
                  ->onDelete('cascade');

            $table->foreign('instructor_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reporte_fallas');
    }
};