<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ingredient_type_id',
        'description',
        'quantity_type',
        'quantity',
        'weight',
        'calories',
        'protein',
        'carbs',
        'sugar',
        'fiber',
        'fat',
        'expires_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function type(): HasOne
    {
        return $this->hasOne(IngredientType::class);
    }

    public function scopeExpired(Builder $query): void
    {
        $query->where('expires_at', '<', now());
    }
}
