<?php

use App\Http\Controllers\API\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return response()->json(['message' => 'Welcome to POS API']);
});

Route::post('/login', [LoginController::class, 'login']);
Route::get('/me', [LoginController::class, 'me'])->middleware('auth:sanctum');

// Route::middleware(['auth:sanctum']->group(function(){}));
