<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return abort(404);
});
Route::get('/post/{slug}', [PostController::class, 'show']);
Route::redirect('/users/', '/users/home');
Route::get('/users/{page?}', [UserController::class, 'manageView'])->where('page', '(home|create|profile|edit|sesi)');
Route::post('/users/typeRequest', [UserController::class, 'manageRequest']);
Route::get('/auth/{page?}', [AuthController::class, 'manageView'])->where('page', '(login|register)');
Route::post('/auth/typeAuth', [AuthController::class, 'manageAuth']);
