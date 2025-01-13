<?php

namespace App\Http\Controllers;

use App\Http\Resources\AutoCompleteResource;
use App\Models\IngredientType;
use Illuminate\Http\Request;

class IngredientTypeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $page = $request->query('page');

        $ingredientTypes = IngredientType::searchAndOrderByName($search, $page);

        return AutoCompleteResource::collection($ingredientTypes);
    }
}
