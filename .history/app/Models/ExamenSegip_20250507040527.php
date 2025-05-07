<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamenSegip
 *
 * @property $id_est
 * @property $id_grupo
 * @property $nro_intento
 * @property $nota_Teorica
 * @property $nota_Practica
 * @property $estado
 * @property $id_categoria
 * @property $created_at
 * @property $updated_at
 *
 * @property ExamenCategoriaAspira $examenCategoriaAspira
 * @property Estudiante $estudiante
 * @property GrupoExaman $grupoExaman
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ExamenSegip extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_est', 'id_grupo', 'nro_intento', 'nota_Teorica', 'nota_Practica', 'estado', 'id_categoria'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examenCategoriaAspira()
    {
        return $this->belongsTo(\App\Models\ExamenCategoriaAspira::class, 'id_categoria', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiante()
    {
        return $this->belongsTo(\App\Models\Estudiante::class, 'id_est', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grupoExaman()
    {
        return $this->belongsTo(\App\Models\GrupoExaman::class, 'id_grupo', 'id');
    }
    
}
