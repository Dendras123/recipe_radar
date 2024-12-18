<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
}
