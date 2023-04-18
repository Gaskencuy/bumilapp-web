<?php

use App\Http\Controllers\API\AndroidLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Android Login
Route::post('/login', [AndroidLogin::class, 'login']);
Route::post('/logout', [AndroidLogin::class, 'logout']);
Route::post('/register', [AndroidLogin::class, 'register']);