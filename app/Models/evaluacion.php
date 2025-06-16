<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluacions'; // Define el nombre específico

    protected $fillable = ['estudiante_id', 'instructor_id', 'estacionamiento', 'zigzag', 'retroceso', 'conduccion_via', 'nota_final', 'fecha_evaluacion'];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
