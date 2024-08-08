<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\CityController;








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

        Route::get('city',[CityController::class,'index'])->name('city');
        Route::get('city/create',[CityController::class,'create']);
        Route::post('city/store',[CityController::class,'store'])->name('city.store');
        Route::get('city/edit/{id}',[CityController::class,'edit']);
        Route::post('city/update/{id}',[CityController::class,'update'])->name('city.update');
        Route::get('city/delete/{id}',[CityController::class,'delete']);
        Route::get('city/destroy/{id}',[CityController::class,'destroy'])->name('city.destroy');
    
    });





// Route::get('/test', function () {
//     return view('content');
// });

// Route::get('/home', 'HomeController@index')->name('home');


