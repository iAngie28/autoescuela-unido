<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
<<<<<<< HEAD
    public function up(): void
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('accion'); 
            $table->string('direccion_ip');
            $table->date('fecha_entrada');
            $table->time('hora_entrada');
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id')->on('users')
            ->onDelete('set null');
            
        });
    }
=======
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

>>>>>>> origin/ismael

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora');
    }
};
