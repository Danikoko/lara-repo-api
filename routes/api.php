<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->prefix('orders')->group(function() {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/fulfilled', [OrderController::class, 'fulfilledOrders']);
    Route::get('{order}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('{order}', [OrderController::class, 'update']);
    Route::delete('{order}', [OrderController::class, 'destroy']);
});

Route::post('/contact', [ContactController::class, 'sendContactMail'])->middleware('api');

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Not Found!'
    ], 404);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
