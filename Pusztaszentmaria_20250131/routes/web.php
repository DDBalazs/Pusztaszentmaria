<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HirekController;
use App\Http\Controllers\VendegkonyvController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hirek', [HirekController::class, 'hirek']);

Route::get('/vendegkonyv', [VendegkonyvController::class, 'vendegkonyv']);
Route::post('/vendegkonyv', [VendegkonyvController::class, 'vendegkonyvData']);

Route::view('/reg', 'reg');
Route::post('/reg', [UserController::class, 'Reg']);

Route::get('login', [UserController::class, 'Login']);
Route::post('/login', [UserController::class, 'LoginData']);

Route::get('/mypage', [UserController::class, 'Mypage']);

Route::get('/logout', [UserController::class, 'Logout']);

Route::get('/newpass', [UserController::class, 'Newpass']);
Route::post('/newpass', [UserController::class, 'NewpassData']);

Route::get('/del', [UserController::class, 'Del']);
