<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportUsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/import',[ImportUsersController::class, 'importUsers']);
Route::post('/import',[ImportUsersController::class, 'importUsers']);
Route::get('/delete',[ImportUsersController::class, 'delete']);
Route::get('/update',[ImportUsersController::class, 'update']);
Route::get('/clear',[ImportUsersController::class, 'clear']);
Route::get('/get',[ImportUsersController::class, 'getUsers']);
Route::get('/point',[ImportUsersController::class, 'point']);

Route::get('/', function () {
    return view('index');
});
