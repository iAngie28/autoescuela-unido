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
 * 
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }
}
