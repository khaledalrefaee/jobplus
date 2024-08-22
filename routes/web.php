<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\CityController;
use App\Http\Controllers\Back\PlanController;
use App\Http\Controllers\Back\UsersController;
use App\Http\Controllers\Back\JobtitleController;
use App\Http\Controllers\Back\SubscripController;
use App\Http\Controllers\Back\companiesController;
use App\Http\Controllers\Back\ScopeWorkController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\SubscriptionController;






Route::get('/', function () {
    return view('welcome');
});





   
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){ 

        ////////////////////////////////// Users \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('register',[AuthController::class,'Register'])->name('Register');
        Route::post('register/form',[AuthController::class,'Registerform'])->name('Register.form');
        Route::get('login',[AuthController::class,'login'])->name('login');
        Route::post('login/form',[AuthController::class,'LoginForm'])->name('login.form');
        
    });
   
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:company' ]
    ], function(){ 

         
        Route::get('logout',[AuthController::class,'logout'])->name('logout');

        Route::get('/dashboard', function () {
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


        ////////////////////////////////// Users \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('users',[UsersController::class,'index'])->name('users');
        Route::get('user/show/{id}',[UsersController::class,'show'])->name('user.show');
        Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::post('/users/update-active/{id}', [UsersController::class, 'updateActiveStatus'])->name('users.updateActive');
        Route::get('/users/cv/download/{id}', [UsersController::class, 'downloadCV'])->name('cv.download');


        ////////////////////////////////// companies \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('companies',[companiesController::class,'index'])->name('companies');
        Route::get('companies/show/{id}',[companiesController::class,'show'])->name('companies.show');
        Route::post('/companies/update-active/{id}', [companiesController::class, 'updateActiveStatus'])->name('companies.updateActive');

        ////////////////////////////////// plans \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('plans',[PlanController::class,'index'])->name('plans');
        Route::post('plan/store',[PlanController::class,'store'])->name('plan.store');
        Route::post('plan/update/{id}',[PlanController::class,'update'])->name('plan.update');
        Route::get('plan/destroy/{id}',[PlanController::class,'destroy'])->name('plan.destroy');


        Route::get('subscriptio',[SubscripController::class,'index'])->name('subscriptio');



        //////////////////////////////////  Admin \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        ////////////////////////////////// plans Admin \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::group(['prefix' => 'admin'], function () {

        Route::get('plans',[AdminPlanController::class,'index'])->name('plans.admin');
        

        Route::post('subscriptio/store',[SubscriptionController::class,'store'])->name('subscriptio.store.admin');

        });
    });





// Route::get('/test', function () {
//     return view('content');
// });

// Route::get('/home', 'HomeController@index')->name('home');


