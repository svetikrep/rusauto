<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'brand',
        'model',
        'slug',
        'year',
        'price',
        'badge',
        'image',
        'mileage',
        'engine',
        'transmission',
        'drive',
        'color',
        'description',
        'is_available',
    ];

    protected $casts = [
        'year' => 'integer',
        'price' => 'integer',
        'is_available' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' ₽';
    }
}
