<?php

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ScopeWorkController;
use App\Http\Controllers\Api\UserDetailController;










Route::group(['middleware' => ['setapplanguage']], function () {


     ///////////////////////////// Apis Get //////////////////////////////////////

    Route::post('city', [CityController::class,'index']);
    Route::post('scope/work', [ScopeWorkController::class,'index']);

    ///////////////////////////// user Details //////////////////////////////////////
    Route::post('user/detail/destroy/{id}',[UserDetailController::class,'destroy']);
    


     ///////////////////////////// user Details //////////////////////////////////////
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
 

});


Route::group(['middleware' => ['auth:sanctum','setapplanguage']], function () {

        ///////////////////////////// user Details //////////////////////////////////////
    
        Route::post('user/detail/store', [UserDetailController::class,'store']);
        Route::post('user/detail/get', [UserDetailController::class,'index']);

        ///////////////////////////// user logout //////////////////////////////////////
    
        Route::post('logout',[AuthController::class,'logout']);
        

        ///////////////////////////// user profile //////////////////////////////////////
        Route::post('user/profile',[AuthController::class,'profile']);
        Route::post('user/update',[AuthController::class,'update']);
        Route::post('user/destroy',[AuthController::class,'destroy']);
});



  
    


