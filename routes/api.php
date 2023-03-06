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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/me', [UserController::class, 'me']);


Route::get('/books', [BookController::class, 'index']);
Route::get('/book/{id}', [UserController::class, 'show']);
Route::post('/book', [UserController::class, 'store']);
Route::patch('/book/{id}', [UserController::class, 'update']);
Route::delete('/book/{id}', [UserController::class, 'destroy']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
