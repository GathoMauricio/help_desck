<?php
use Illuminate\Support\Facades\Route;
Auth::routes();
Route::get('/', function(){ return view('login'); })->name('/')->middleware('guest');
Route::get('/home', function(){ return view('home'); })->name('home')->middleware('auth');

Route::group(['middleware' => ['auth','admin']],function(){
    Route::get('usuarios',function(){ return view('user.index'); })->name('usuarios');
});
