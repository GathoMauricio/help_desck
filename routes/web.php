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
    Route::get('service_suggestion',function(){ return view('service_suggestion.index'); })->name('service_suggestion');
});


Route::group(['middleware' => ['auth']],function(){
    Route::get('cases',function(){ return view('case.index'); })->name('cases');
    Route::get('cases_p',function(){ return view('case.index_p'); })->name('cases_p');
    Route::get('cases_e',function(){ return view('case.index_e'); })->name('cases_e');
    Route::get('cases_c',function(){ return view('case.index_c'); })->name('cases_c');
    Route::get('cases_unassigned',function(){ return view('case.unassigned'); })->name('cases_unassigned');
    Route::get('index_case_follow/{id?}',[\App\Http\Controllers\CaseFollowController::class,'index'])->name('index_case_follow');
    Route::get('store_case_follow',[\App\Http\Controllers\CaseFollowController::class,'store'])->name('store_case_follow');
    Route::get('binnacle_images_index/{id?}',[\App\Http\Controllers\BinnacleImageController::class,'index'])->name('binnacle_images_index');
});


Route::get('fcm',function(){
    return sendFcm(
        'cigCTiq-Sfe0jUpyvmke_S:APA91bG5-7XR4qUE8pJiACu83NDzAoNEj5KZgKlzmpjSq_uCM42crLruX568KDi44f8MH6iSCjLGh4-07WS09jdXl24eSjbhQAb7C17a0wHP6MJDA-DEz9EGYB8vyyBZ6_sBFD9cb4vc', 
        'Test', 'Primer prueba', ['dato1' => "sdsadcxzc", 'dato2' => "mdlkfkdngnfld"]);
})->name('fcm');