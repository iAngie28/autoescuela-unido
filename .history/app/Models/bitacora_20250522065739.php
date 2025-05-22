<?php

namespace App\Models;

<<<<<<< HEAD
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
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bitacora
 *
 * @property $id
 * @property $direccion_ip
 * @property $visitas
 * @property $acciones
 * @property $id_user
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */


class Bitacora extends Model
>>>>>>> origin/ismael
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'bitacora';
<<<<<<< HEAD
    protected $fillable = ['id_user','id','direccion_ip','fecha_entrada','hora_entrada','fecha_salida','hora_salida'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id');
    }
=======
    protected $fillable = ['id_user', 'direccion_ip', 'visitas', 'acciones'];

   /**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}

>>>>>>> origin/ismael
}
