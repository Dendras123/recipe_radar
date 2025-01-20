<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recepie\StoreRecepieRequest;

class RecepieController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return $user->recepies()->get();
    }

    public function store(StoreRecepieRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->user();

        $recepie = $user->recepies()->create($validated);
        $recepie->ingredient_types()->attach($validated['ingredient_types']);
    }
}
