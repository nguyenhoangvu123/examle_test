<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\Category\CategoryApiController;
use App\Http\Controllers\Layout\LayoutApiController;

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
Route::post('/login', [AuthApiController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function(){  
    // Category Strore //
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryApiController::class, 'index']);
        Route::post('/store', [CategoryApiController::class, 'store']);
        Route::get('/{id}', [CategoryApiController::class, 'show']);
        Route::put('/update/{id}', [CategoryApiController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryApiController::class, 'delete']);

    });

    Route::group(['prefix' => 'layout'], function () {
        Route::get('/', [LayoutApiController::class, 'index']);
        Route::post('/store', [LayoutApiController::class, 'store']);
        Route::get('/{id}', [LayoutApiController::class, 'show']);
        Route::post('/update/{id}', [LayoutApiController::class, 'update']);
        Route::delete('/delete/{id}', [LayoutApiController::class, 'delete']);
        
    });
});
