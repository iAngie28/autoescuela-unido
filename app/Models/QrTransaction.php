<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrTransaction extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'amount',
        'description',
        'client_name',
        'qr_image_url',
        'status',
    ];
}
