<?php
use Illuminate\Support\Facades\Route;
Auth::routes();
Route::view('/', 'login')->name('/')->middleware('guest');
Route::view('/home', 'home')->name('home')->middleware('auth');

Route::group(['middleware' => ['auth','admin']],function(){
    Route::view('usuarios','usuario.index')->name('usuarios');
});
