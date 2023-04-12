<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataPoliController;
use App\Http\Controllers\DetailPengingatController;
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
})->middleware('isStay');

Route::get('/', function () {
    return view('login');
})->middleware('isStay');

Route::get('/index', function () {
    return view('pages.index');
})->middleware('isLogin');


Route::get('/login', [AuthController::class, 'index'])->middleware('isStay');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/pengingat', [PengingatController::class, 'index'])->middleware('isLogin');
Route::post('/pengingat', [PengingatController::class, 'create'])->middleware('isLogin');
Route::put('/pengingat-update/{id}', [PengingatController::class, 'update'])->middleware('isLogin');
Route::delete('/pengingat-delete/{id}', [PengingatController::class, 'delete'])->middleware('isLogin');

Route::get('/datauser', [UserController::class, 'index'])->middleware('isLogin');
Route::post('/datauser', [UserController::class, 'create'])->middleware('isLogin');
Route::put('/datauser-update/{id}', [UserController::class, 'update'])->middleware('isLogin');
Route::delete('/datauser-delete/{id}', [UserController::class, 'delete'])->middleware('isLogin');

Route::get('/datapoli', [DataPoliController::class, 'index'])->middleware('isLogin');
Route::post('/datapoli', [DataPoliController::class, 'create'])->middleware('isLogin');
Route::delete('/datapoli-delete/{id}', [DataPoliController::class, 'delete'])->middleware('isLogin');
Route::put('/datapoli-update/{id}', [DataPoliController::class, 'update'])->middleware('isLogin');

Route::get('/datapengingat', [DetailPengingatController::class, 'index'])->middleware('isLogin');
Route::post('/datapengingat', [DetailPengingatController::class, 'create'])->middleware('isLogin');
Route::delete('/datapengingat-delete/{id}', [DetailPengingatController::class, 'delete'])->middleware('isLogin');
Route::put('/datapengingat-update/{id}', [DetailPengingatController::class, 'update'])->middleware('isLogin');
