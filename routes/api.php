<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IngredientTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

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
            Route::delete('/{ingredient}', 'delete');
            Route::delete('/expired', 'deleteExpired');
        });

    Route::get('/ingredient-types', [IngredientTypeController::class, 'index']);
});


