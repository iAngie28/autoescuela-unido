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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->string('placa', 20)->primary();
            $table->string('modelo', 20);
            $table->string('caracteristicas', 50);
            $table->timestamps();
            $table->unsignedBigInteger('tipo');
            $table->foreign('tipo')
            ->references('id')->on('tipo_vehiculo')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
