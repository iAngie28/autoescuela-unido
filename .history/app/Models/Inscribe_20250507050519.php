<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Inscribe
 *
 * @property $id
 * @property $fecha_Insc
 * @property $categoria_actual
 * @property $id_categoria
 * @property $id_pago
 * @property $id_paquete
 * @property $created_at
 * @property $updated_at
 *
 * @property ExamenCategoriaAspira $examenCategoriaAspira
 * @property Pago $pago
 * @property Paquete $paquete
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inscribe extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha_Insc', 'categoria_actual', 'id_categoria', 'id_pago', 'id_paquete'];


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
    public function pago()
    {
        return $this->belongsTo(\App\Models\Pago::class, 'id_pago', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paquete()
    {
        return $this->belongsTo(\App\Models\Paquete::class, 'id_paquete', 'id');
    }
    
}
