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
    Schema::create('bitacora', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_user')->nullable();
        $table->string('direccion_ip', 45); // Para admitir IPv6
        $table->string('visitas')->nullable(); // Página visitada
        $table->text('acciones')->nullable(); // Acción realizada
        $table->timestamps(); // Laravel manejará fecha/hora de entrada/salida

        $table->foreign('id_user')
            ->references('id')->on('users')
            ->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora');
    }
};
