<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteFalla extends Model
{
    protected $fillable = [
        'vehiculo_id',
        'instructor_id',
        'descripcion',
        'estado'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}