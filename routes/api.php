<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [Authentication::class, 'register']);
Route::post('/login', [Authentication::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [Authentication::class, 'logout']);

    Route::post('/user/create', [UserController::class, 'create']);
    Route::get('/user/all', [UserController::class, 'all']);
    Route::get('/user/get/{id}', [UserController::class, 'get']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->middleware('admin');
});


