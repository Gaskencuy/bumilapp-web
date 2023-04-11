<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', function () {
    return view('login');
});

Route::get('/index', function () {
    return view('pages.index');
});

Route::get('/datauser', function () {
    return view('pages.datauser');
});

Route::get('/datapengingat', function () {
    return view('pages.datapengingat');
});

Route::get('/datapoli', function () {
    return view('pages.datapoli');
});

Route::get('/pengingat', function () {
    return view('pages.pengingat');
});
