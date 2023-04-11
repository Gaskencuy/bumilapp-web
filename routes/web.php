<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengingatController;

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/pengingat', [PengingatController::class, 'index']);
Route::post('/pengingat', [PengingatController::class, 'create']);
Route::put('/pengingat-update/{id}', [PengingatController::class, 'update']);
Route::delete('/pengingat-delete/{id}', [PengingatController::class, 'delete']);

Route::get('/datauser', [UserController::class, 'index']);
Route::post('/datauser', [UserController::class, 'create']);
Route::put('/datauser-update/{id}', [UserController::class, 'update']);
Route::delete('/datauser-delete/{id}', [UserController::class, 'delete']);


Route::get('/', function () {
    return view('login');
});

Route::get('/index', function () {
    return view('pages.index');
});

Route::get('/datapengingat', function () {
    return view('pages.datapengingat');
});

Route::get('/datapoli', function () {
    return view('pages.datapoli');
});
