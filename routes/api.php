<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('/posts', \App\Http\Controllers\PostController::class);

// Public API
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'store'])->name('authentication');

// Private API
Route::middleware('auth:sanctum')->group(function (){
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store']);

    Route::put('/posts/{post}', [\App\Http\Controllers\PostController::class, 'update']);

    Route::delete('/posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy']);

    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');
});
