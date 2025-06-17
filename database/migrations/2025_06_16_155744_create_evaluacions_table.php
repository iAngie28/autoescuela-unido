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
        Schema::create('evaluacions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('estudiante_id')->constrained('users')->onDelete('cascade'); // FK con Users (Estudiante)
         $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null'); // FK con Users (Instructor)
        $table->enum('estacionamiento', ['Excelente', 'Bueno', 'Regular']);
        $table->enum('zigzag', ['Excelente', 'Bueno', 'Regular']);
        $table->enum('retroceso', ['Excelente', 'Bueno', 'Regular']);
        $table->enum('conduccion_via', ['Excelente', 'Bueno', 'Regular']);
        $table->integer('nota_final');
        $table->timestamp('fecha_evaluacion')->default(now());
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};
