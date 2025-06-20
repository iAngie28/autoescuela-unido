<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Clase
 *
 * @property $id
 * @property $fecha
 * @property $hora_inicio
 * @property $hora_fin
 * @property $estado
 * @property $comentario_Inst
 * @property $reporte_estudiante
 * @property $id_paquete
 *
 * @property $id_inst
 * @property $created_at
 * @property $updated_at
 *
 * @property Instructor $instructor
 * @property Paquete $paquete
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Clase extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'clase';
    protected $fillable = ['fecha', 'hora_inicio', 'hora_fin', 'estado', 'comentario_Inst', 'reporte_estudiante', 'id_paquete', 'id_inst', 'id_est','id_pago'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor()
    {
        return $this->belongsTo(\App\Models\Instructor::class, 'id_inst', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paquete()
    {
        return $this->belongsTo(\App\Models\Paquete::class, 'id_paquete', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiante()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_est', 'id');
    }

public function pago()
{
    return $this->belongsTo(Pago::class, 'id_pago');
}

}
