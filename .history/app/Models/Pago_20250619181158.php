<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 *
 * @property int $id
 * @property int $monto
 * @property string $fecha
 * @property int $descuento
 * @property string|null $detalle
 * @property string|null $estado
 * @property int $id_est
 * @property int $id_adm
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $administrador
 * @property User $estudiante
 * @property Inscribe[] $inscribes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */

class Pago extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'pago';
    protected $fillable = ['monto', 'fecha', 'descuento', 'id_est', 'id_adm'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function administrador()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_adm', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiante()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_est', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscribes()
    {
        return $this->hasMany(\App\Models\Inscribe::class, 'id', 'id_pago');
    }
    
}
