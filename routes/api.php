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

Route::group(['prefix' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function(){
        Route::get('get', [\App\Http\Controllers\API\AuthController::class, 'index'])->name('index');
    });
});

Route::group(['prefix' => 'ticket'], function () {
        Route::get('list-get', [\App\Http\Controllers\API\TicketController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('list-order', [\App\Http\Controllers\API\OrderController::class, 'index'])->name('index');
});

Route::group(['prefix'=> '/'], function() {
    Route::get('/', function(){
        return response()->json(
            ['API' => "Management Ticket"]
        );
    });
});
