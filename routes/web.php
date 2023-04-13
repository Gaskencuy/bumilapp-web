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
})->middleware('IsStay');

Route::get('/', function () {
    return view('login');
})->middleware('IsStay');

Route::get('/index', function () {
    return view('pages.index');
})->middleware('IsLogin');



Route::get('/login', [AuthController::class, 'index'])->middleware('IsStay');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/pengingat', [PengingatController::class, 'index'])->middleware('IsLogin');
Route::post('/pengingat', [PengingatController::class, 'create'])->middleware('IsLogin');
Route::put('/pengingat-update/{id}', [PengingatController::class, 'update'])->middleware('IsLogin');
Route::delete('/pengingat-delete/{id}', [PengingatController::class, 'delete'])->middleware('IsLogin');

Route::get('/datauser', [UserController::class, 'index'])->middleware('IsLogin');
Route::get('/datauser-detail/{id}', [UserController::class, 'detailuser'])->middleware('IsLogin');
Route::post('/datauser', [UserController::class, 'create'])->middleware('IsLogin');
Route::put('/datauser-update/{id}', [UserController::class, 'update'])->middleware('IsLogin');
Route::delete('/datauser-delete/{id}', [UserController::class, 'delete'])->middleware('IsLogin');

Route::get('/datapoli', [DataPoliController::class, 'index'])->middleware('IsLogin');
Route::post('/datapoli', [DataPoliController::class, 'create'])->middleware('IsLogin');
Route::delete('/datapoli-delete/{id}', [DataPoliController::class, 'delete'])->middleware('IsLogin');
Route::put('/datapoli-update/{id}', [DataPoliController::class, 'update'])->middleware('IsLogin');

Route::get('/datapengingat', [DetailPengingatController::class, 'index'])->middleware('IsLogin');
Route::post('/datapengingat', [DetailPengingatController::class, 'create'])->middleware('IsLogin');
Route::delete('/datapengingat-delete/{id}', [DetailPengingatController::class, 'delete'])->middleware('IsLogin');
Route::put('/datapengingat-update/{id}', [DetailPengingatController::class, 'update'])->middleware('IsLogin');
