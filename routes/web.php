<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [\App\Http\Controllers\ClientController::class, 'index']);
Route::post('/store', [\App\Http\Controllers\ClientController::class, 'store']);
Route::get('/edit-client/{id}', [\App\Http\Controllers\ClientController::class, 'edit']);
Route::post('/update', [\App\Http\Controllers\ClientController::class, 'update']);
Route::get('/delete-client/{id}', [\App\Http\Controllers\ClientController::class, 'delete']);
