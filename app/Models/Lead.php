<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'name',
        'phone',
        'message',
        'status',
        'ip_address',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
