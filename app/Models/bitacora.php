<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class bitacora
 *
 * @property $id
 * @property $accion
 * @property $direccion_ip
 * @property $fecha_entrada
 * @property $hora_entrada
 * @property $fecha_salida
 * @property $hora_salida
 * @property $id_user
 * 
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class bitacora extends Model
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'bitacora';
    protected $fillable = ['id_user','id','direccion_ip','fecha_entrada','hora_entrada','fecha_salida','hora_salida'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id');
    }
}
