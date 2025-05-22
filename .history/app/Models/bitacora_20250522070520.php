<?php

namespace App\Models;

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
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'bitacora';
    protected $fillable = ['id_user', 'direccion_ip', 'visitas', 'acciones'];

   /**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}

}
