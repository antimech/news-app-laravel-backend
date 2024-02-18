<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LikeController;
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

Route::apiResource('articles', ArticleController::class)
    ->only(['index', 'show']);

Route::apiResource('articles.comments', ArticleCommentController::class)
    ->only(['index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('articles', ArticleController::class)
        ->only(['store', 'destroy']);

    Route::post('articles/{article}/like', [LikeController::class, 'store']);
    Route::delete('articles/{article}/like', [LikeController::class, 'destroy']);

    Route::apiResource('articles.comments', ArticleCommentController::class)
        ->shallow()
        ->only(['store', 'destroy']);
});
