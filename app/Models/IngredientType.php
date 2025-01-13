<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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

    public static function searchAndOrderByName(string|null $search, int $page): Collection
    {
        return self::when(
            !empty($search),
            fn($query) => $query->whereLike('name', '%' . $search . '%')
        )
            // FIXME: orderby doesn't work with utf8 
            ->orderBy('name')
            ->offset($page * 100)
            ->limit(100)
            ->get();
    }
}
