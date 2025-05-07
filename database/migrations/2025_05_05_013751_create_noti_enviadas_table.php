<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    public function up(): void
    {
        Schema::create('noti_enviadas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_noti');
            $table->unsignedBigInteger('id_user');
            $table->time('hora_recibida');
            $table->timestamps();

            // Definir la clave primaria compuesta
            $table->primary(['id_noti', 'id_user']);

            // Definir las claves foráneas
            $table->foreign('id_noti')->references('id')->on('notificacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noti_enviadas');

    }
};


