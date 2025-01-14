<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recepie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'prep_time',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function ingredient_types(): BelongsToMany
    {
        return $this->belongsToMany(
            IngredientType::class,
            'recepies_ingredient_types',
            'recepie_id',
            'ingredient_type_id'
        );
    }
}
