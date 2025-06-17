<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    
    protected $table = 'evaluaciones';
    
    protected $fillable = [
        'estudiante_id',
        'instructor_id',
        'estacionamiento',
        'zigzag',
        'retroceso',
        'conduccion_via',
        'nota_final',
        'fecha_evaluacion',
    ];

    protected $casts = [
        'fecha_evaluacion' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenSegips()
    {
        return $this->hasMany(\App\Models\ExamenSegip::class, 'id', 'id_est');
    }
    
    public function clase()
    {
        return $this->hasMany(\App\Models\Clase::class, 'id_est', 'id');

    }
}