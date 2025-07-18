<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Instructor
 *
 * @property $id
 * @property $categ_licencia
 * @property $created_at
 * @property $updated_at
 * @property $id_vehiculo
 * 
 * @property Usuario $usuario
 * @property Clase[] $clases
 * @property Vehiculo $vehiculo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Instructor extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'instructor';
    protected $fillable = ['categ_licencia', 'id_vehiculo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clases()
    {
        return $this->hasMany(\App\Models\Clase::class, 'id', 'id_inst');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehiculo()
    {
        return $this->belongsTo(\App\Models\Vehiculo::class, 'id_vehiculo', 'id');
    }
    
}
