<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BookController;

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

Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');

Route::get('/books', [BookController::class, 'index'])->middleware('auth:sanctum');
Route::get('/book/{id}', [BookController::class, 'show'])->middleware('auth:sanctum');
Route::post('/book', [BookController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/book/{id}', [BookController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/book/{id}', [BookController::class, 'destroy'])->middleware('auth:sanctum');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
