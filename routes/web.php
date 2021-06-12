<?php
use Illuminate\Support\Facades\Route;
Auth::routes();
Route::get('/', function(){ return view('login'); })->name('/')->middleware('guest');
Route::get('/home', function(){ return view('home'); })->name('home')->middleware('auth');

Route::group(['middleware' => ['auth','admin']],function(){
    Route::get('users',function(){ return view('user.index'); })->name('users');
    Route::get('companies',function(){ return view('company.index'); })->name('companies');
    Route::get('company_branches_by_id/{id}',function(){ return view('company_branch_by_id.index'); })->name('company_branches_by_id');
    Route::get('company_branches',function(){ return view('company_branch.index'); })->name('company_branches');
    Route::get('service_areas',function(){ return view('service_area.index'); })->name('service_areas');
    Route::get('service_types',function(){ return view('service_type.index'); })->name('service_types');
    Route::get('service_categories',function(){ return view('service_category.index'); })->name('service_categories');
    Route::get('service_simptoms',function(){ return view('service_simptom.index'); })->name('service_simptoms');
});

Route::get('cases',function(){ return view('case.index'); })->name('cases');