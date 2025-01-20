<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IngredientTypeController;
use App\Http\Controllers\RecepieController;
use App\Http\Controllers\RecipeScraperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

Route::get('/recipes/scraper', [RecipeScraperController::class, '__invoke']);

// not logged in routes
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);

// logged in routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [UserAuthController::class, 'logout']);

    Route::controller(IngredientController::class)
        ->prefix('/ingredients')
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::delete('/', 'deleteAll');
            Route::delete('/expired', 'deleteExpired');
            Route::delete('/{ingredient}', 'delete');
        });

    Route::get('/ingredient-types', [IngredientTypeController::class, 'index']);

    Route::controller(RecepieController::class)
        ->prefix('/recepies')
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
        });
});
