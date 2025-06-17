<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluacions'; // Define el nombre específico

    protected $fillable = ['estudiante_id', 'instructor_id', 'estacionamiento', 'zigzag', 'retroceso', 'conduccion_via', 'nota_final', 'fecha_evaluacion'];

    protected $casts = [
        'fecha_evaluacion' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function getEstadoAttribute()
    {
        return $this->nota_final >= 60 ? 'Aprobado' : 'Reprobado';
    }

    public function getEstadoClaseAttribute()
    {
        return $this->nota_final >= 60 ? 'success' : 'danger';
    }

    public function getEstadoIconoAttribute()
    {
        return $this->nota_final >= 60 ? 'fa-check-circle' : 'fa-times-circle';
    }

    public function scopeAprobadas($query)
    {
        return $query->where('nota_final', '>=', 60);
    }

    public function scopeReprobadas($query)
    {
        return $query->where('nota_final', '<', 60);
    }

    public function scopeDeEstudiante($query, $estudianteId)
    {
        return $query->where('estudiante_id', $estudianteId);
    }

    public function scopeDeInstructor($query, $instructorId)
    {
        return $query->where('instructor_id', $instructorId);
    }
}
