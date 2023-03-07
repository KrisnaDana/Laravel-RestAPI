<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BookController;
use App\Http\Middleware\Feature\BookMiddleware;

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
Route::middleware(['throttle:60,1'])->group(function() {
    Route::post('/login', [UserController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get('/me', [UserController::class, 'me']);
        
        Route::middleware(['ability:A'])->group(function() {
            Route::get('/books', [BookController::class, 'index']);
            Route::get('/book/{id}', [BookController::class, 'show'])->middleware([BookMiddleware::class]);
        });
        Route::middleware(['ability:B'])->group(function() {
            Route::patch('/book/{id}', [BookController::class, 'update'])->middleware([BookMiddleware::class]);
            Route::post('/book', [BookController::class, 'store']);
            Route::delete('/book/{id}', [BookController::class, 'destroy'])->middleware([BookMiddleware::class]);
        });
    });
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
