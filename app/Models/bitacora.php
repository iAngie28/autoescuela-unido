<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

/**
 * Class bitacora
 *
 * @property $id
 * @property $accion
 * @property $direccion_ip
 * @property $fecha_entrada
 * @property $fecha_salida
 * @property $id_user
 */
class Bitacora extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'Bitacora';
    protected $fillable = [
        'id_user',
        'direccion_ip',
        'fecha_entrada',
        'accion',
        'fecha_salida'];

        // Convertir automáticamente estos campos a instancias Carbon
        protected $casts = [
            'fecha_entrada' => 'datetime',
            'fecha_salida' => 'datetime',
        ];

    public function relacionUsuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
