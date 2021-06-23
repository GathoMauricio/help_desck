<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('login',[\App\Http\Controllers\UserController::class,'login'])->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});