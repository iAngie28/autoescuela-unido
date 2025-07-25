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
        Schema::create('examen_segip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_est');
            $table->unsignedBigInteger('id_grupo');
            $table->integer('nro_intento');
            $table->integer('nota_Teorica')->nullable();
            $table->integer('nota_Practica')->nullable();
            $table->string('estado', 15);
            $table->unsignedBigInteger('id_categoria');

            $table->unsignedBigInteger('id_pago');
            $table->foreign('id_pago')
                ->references('id')
                ->on('pago')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->foreign('id_categoria')
            ->references('id')->on('examen_categoria_aspira')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_est')
            ->references('id')->on('estudiante')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_grupo')
            ->references('id')->on('grupo_examen')
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
        Schema::dropIfExists('examen_segip');
    }
};
