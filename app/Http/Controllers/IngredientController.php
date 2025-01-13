<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ingredient\StoreIngredientRequest;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return $user->ingredients()->get();
    }

    public function store(StoreIngredientRequest $request)
    {
        $validated = $request->validated();
        $ingredients = $validated['ingredients'];

        $user = auth()->user();

        foreach ($ingredients as $ingredient) {
            $user->ingredients()->create($ingredient);
        }

        return response()->json('Created successfully!', 201);
    }

    public function delete(Ingredient $ingredient)
    {
        $ingredient->delete();
    }

    public function deleteExpired()
    {
        $user = auth()->user();

        $user->ingredients()->expired()->delete();
    }

    public function deleteAll()
    {
        $user = auth()->user();

        $user->ingredients()->delete();
    }
}
