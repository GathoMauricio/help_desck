<?php
//header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('login',[\App\Http\Controllers\UserController::class,'login'])->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')
->put('update_fcm_token',[\App\Http\Controllers\UserController::class,'UpdateFcmToken'])
->name('update_fcm_token');

Route::middleware('auth:api')
->get('case_index',[\App\Http\Controllers\CaseController::class,'index'])
->name('case_index');

Route::middleware('auth:api')
->get('case_create',[\App\Http\Controllers\CaseController::class,'create'])
->name('case_create');

Route::middleware('auth:api')
->post('case_store',[\App\Http\Controllers\CaseController::class,'store'])
->name('case_store');

Route::middleware('auth:api')
->get('change_area',[\App\Http\Controllers\CaseController::class,'changeArea'])
->name('change_area');

Route::middleware('auth:api')
->get('change_servicio',[\App\Http\Controllers\CaseController::class,'changeServicio'])
->name('change_servicio');

Route::middleware('auth:api')
->get('change_categoria',[\App\Http\Controllers\CaseController::class,'changeCategoria'])
->name('change_categoria');