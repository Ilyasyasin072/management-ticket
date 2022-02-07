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
        Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register'])->name('register');
        Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('profile', function(Request $request) {
                return auth()->user();
            });
            Route::get('get', [\App\Http\Controllers\API\AuthController::class, 'index'])->name('index');
            // API route for logout user
            Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

            Route::group(['prefix' => 'order'], function () {
                Route::get('list-order', [\App\Http\Controllers\API\OrderController::class, 'index'])->name('index');
            });

            Route::group(['prefix' => 'payment'], function () {
                Route::get('payment-checkout', [\App\Http\Controllers\API\PaymentController::class, 'index'])->name('index');
            });
        });

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::group(['prefix' => 'order-ticket'], function() {
                Route::post('create', [\App\Http\Controllers\API\OrderController::class, 'create'])->name('order-ticket');
            });
            Route::group(['prefix' => 'checkout-order'], function() {
                Route::post('/', [\App\Http\Controllers\API\PaymentController::class, 'create'])->name('checkout-pay');
            });

            Route::group(['prefix'=> 'status-payment'], function() {
                Route::get('/{id}', [\App\Http\Controllers\API\PaymentController::class, 'showPayOrder'])->name('status-payment');
            });
        });

    });
});

Route::group(['prefix' => 'ticket'], function () {
    Route::get('list-get', [\App\Http\Controllers\API\TicketController::class, 'index'])->name('index');
});


Route::group(['prefix'=> '/'], function() {
    Route::get('/', function(){
        return response()->json(
            ['API' => "Management Ticket"]
        );
    });
});

Route::get('storage/{filename}', function ($filename)
{
    $path =  \Storage::disk('public')->path('pay11321c39.png',DNS1D::getBarcodePNGPath('pay11321c39', 'C39+', true));

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
