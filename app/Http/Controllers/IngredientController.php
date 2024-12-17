<?php

namespace App\Http\Controllers;

use App\Http\Ingredient\Requests\StoreIngredientRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;

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

        $user = auth()->user();

        $user->ingredients()->create($validated);
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
