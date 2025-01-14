<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recepie\StoreRecepieRequest;

class RecepieController extends Controller
{
    public function store(StoreRecepieRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->user();

        $recepie = $user->recepies()->create($validated);
        $recepie->ingredient_types()->attach($validated['ingredient_types']);
    }
}
