<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notificacione extends Model

{

    protected $perPage = 20;

    protected $fillable = [
        'mensaje', 
        'tipo', 
        'fecha',
        'user_id',
        'leido'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'leido' => 'boolean'
    ];

    /**
     * Usuario destinatario de la notificación
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function scopeNoLeidas($query)
    {
        return $query->where('leido', false);
    }

    /**
     * Scope para notificaciones de un usuario
     */
    public function scopeDeUsuario($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}