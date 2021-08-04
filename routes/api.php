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
->put('delete_fcm',[\App\Http\Controllers\UserController::class,'DeleteFcmToken'])
->name('delete_fcm');

Route::middleware('auth:api')
->get('load_all_cases',[\App\Http\Controllers\CaseController::class,'loadAllCases'])
->name('load_all_cases');

Route::middleware('auth:api')
->get('load_pending_cases',[\App\Http\Controllers\CaseController::class,'loadPendingCases'])
->name('load_pending_cases');

Route::middleware('auth:api')
->get('load_progress_cases',[\App\Http\Controllers\CaseController::class,'loadProgressCases'])
->name('load_progress_cases');

Route::middleware('auth:api')
->get('load_finish_cases',[\App\Http\Controllers\CaseController::class,'loadFinishCases'])
->name('load_finish_cases');


Route::middleware('auth:api')
->get('load_unasigned_cases',[\App\Http\Controllers\CaseController::class,'loadUnasignedCases'])
->name('load_unasigned_cases');

Route::middleware('auth:api')
->get('obtener_areas',[\App\Http\Controllers\CaseController::class,'obetenerAreas'])
->name('obtener_areas');


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

Route::middleware('auth:api')
->get('change_sintoma',[\App\Http\Controllers\CaseController::class,'changeSintoma'])
->name('change_sintoma');

Route::middleware('auth:api')
->put('tomar_caso',[\App\Http\Controllers\CaseController::class,'tomarCaso'])
->name('tomar_caso');

Route::middleware('auth:api')
->get('ver_seguimientos',[\App\Http\Controllers\CaseFollowController::class,'verSeguimientos'])
->name('ver_seguimientos');

Route::middleware('auth:api')
->post('guardar_seguimiento',[\App\Http\Controllers\CaseFollowController::class,'guardarSeguimiento'])
->name('guardar_seguimiento');

Route::middleware('auth:api')
->get('recargar_seguimientos',[\App\Http\Controllers\CaseFollowController::class,'recargarSeguimientos'])
->name('recargar_seguimientos');

Route::middleware('auth:api')
->get('ver_bitacoras',[\App\Http\Controllers\CaseBinnacleController::class,'verBitacoras'])
->name('ver_bitacoras');

Route::middleware('auth:api')
->post('guardar_bitacora',[\App\Http\Controllers\CaseBinnacleController::class,'guardarBitacora'])
->name('guardar_bitacora');

Route::middleware('auth:api')
->post('guardar_imagen_bitacora',[\App\Http\Controllers\BinnacleImageController::class,'guardarImagenBitacora'])
->name('guardar_imagen_bitacora');

Route::middleware('auth:api')
->get('ver_imagenes_bitacoras',[\App\Http\Controllers\BinnacleImageController::class,'verImagenesBitacoras'])
->name('ver_imagenes_bitacoras');