<?php

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\ScopeWorkController;
use App\Http\Controllers\Api\UserDetailController;
use App\Http\Controllers\Api\BusinessGalleryController;










Route::group(['middleware' => ['setapplanguage']], function () {


     ///////////////////////////// Apis Get //////////////////////////////////////

    Route::post('city', [CityController::class,'index']);
    Route::post('scope/work', [ScopeWorkController::class,'index']);

    ///////////////////////////// user Details delete //////////////////////////////////////
    Route::post('user/detail/destroy/{id}',[UserDetailController::class,'destroy']);
    


     ///////////////////////////// user create and login //////////////////////////////////////
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
 

});


Route::group(['middleware' => ['auth:sanctum','setapplanguage']], function () {

        ///////////////////////////// user Details //////////////////////////////////////
    
        Route::post('user/detail/store', [UserDetailController::class,'store']);
        Route::post('user/detail/get', [UserDetailController::class,'index']);
        Route::post('user/detail/update/{id}', [UserDetailController::class,'update']);


        ///////////////////////////// user logout //////////////////////////////////////
    
        Route::post('logout',[AuthController::class,'logout']);
        

        ///////////////////////////// user profile //////////////////////////////////////
        Route::post('user/profile',[AuthController::class,'profile']);
        Route::post('user/update',[AuthController::class,'update']);
        Route::post('user/destroy',[AuthController::class,'destroy']);


        ///////////////////////////// BusinessGallery //////////////////////////////////////
        Route::post('user/Business/Gallery/get',[BusinessGalleryController::class,'index']);
        Route::post('user/Business/Gallery/store',[BusinessGalleryController::class,'store']);
        Route::post('user/Business/Gallery/update/{id}',[BusinessGalleryController::class,'update']);
        Route::post('user/Business/Gallery/destroy/{id}',[BusinessGalleryController::class,'destroy']);


         ///////////////////////////// Skills User //////////////////////////////////////
         Route::post('user/skill/get',[SkillController::class,'index']);
         Route::post('user/skill/store',[SkillController::class,'store']);
         Route::post('user/skill/update/{id}',[SkillController::class,'update']);
         Route::post('user/skill/destroy/{id}',[SkillController::class,'destroy']);


         ///////////////////////////// Language //////////////////////////////////////

         Route::post('user/language/get',[LanguageController::class,'index']);
         Route::post('user/language/store',[LanguageController::class,'store']);
         Route::post('user/language/update/{id}',[LanguageController::class,'update']);
         Route::post('user/language/destroy/{id}',[LanguageController::class,'destroy']);
});



  
    


