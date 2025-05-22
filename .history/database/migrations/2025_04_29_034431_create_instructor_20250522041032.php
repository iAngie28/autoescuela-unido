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
        Schema::create('instructor', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('categ_licencia', 10);
            $table->timestamps();
<<<<<<<< HEAD:.history/database/migrations/2025_04_29_034431_create_instructor_20250522041032.php
            $table->unsignedBigInteger('id_vehiculo');
========
            $table->unsignedBigInteger('id_vehiculo')->nullable();
>>>>>>>> origin/ismael:database/migrations/2025_04_29_034431_create_instructor.php
            $table->foreign('id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_vehiculo')
            ->references('id')->on('vehiculo')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor');
    }
};
