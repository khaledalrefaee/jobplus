<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\CityController;
use App\Http\Controllers\Back\JobtitleController;
use App\Http\Controllers\Back\ScopeWorkController;








Route::get('/', function () {
    return view('welcome');
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 

        Route::get('/home', function () {
            return view('content');
        });

        ////////////////////////////////// City \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('city',[CityController::class,'index'])->name('city');
        Route::post('city/store',[CityController::class,'store'])->name('city.store');
        Route::post('city/update/{id}',[CityController::class,'update'])->name('city.update');
        Route::get('city/destroy/{id}',[CityController::class,'destroy'])->name('city.destroy');
    

        ////////////////////////////////// scope_work \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('scope/work',[ScopeWorkController::class,'index'])->name('scope_work');
        Route::post('scope/work/store',[ScopeWorkController::class,'store'])->name('scope_work.store');
        Route::post('scope/work/update/{id}',[ScopeWorkController::class,'update'])->name('scope_work.update');
        Route::get('scope/work/destroy/{id}',[ScopeWorkController::class,'destroy'])->name('scope_work.destroy');


                ////////////////////////////////// Job Title \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                Route::get('job/title',[JobtitleController::class,'index'])->name('job_title');
                Route::post('job/title/store',[JobtitleController::class,'store'])->name('job_title.store');
                Route::post('job/title/update/{id}',[JobtitleController::class,'update'])->name('job_title.update');
                Route::get('job/title/destroy/{id}',[JobtitleController::class,'destroy'])->name('job_title.destroy');
    });





// Route::get('/test', function () {
//     return view('content');
// });

// Route::get('/home', 'HomeController@index')->name('home');


