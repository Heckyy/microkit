<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::controller(HomeController::class)->group(function () {
    Route::get("/", "index");
    Route::middleware(['auth'])->group(function () {
        Route::get("/profile-setting", "profileSetting");
        Route::get("/profile-setting/update", function () {
            redirect('/sign-in');
        });
        Route::post("/profile-setting/update", "update");

        Route::get('/download', 'download');
    });
});




Route::controller(AuthenticationController::class)->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/sign-in', 'login')->name('sign-in');

        Route::post('/sign-in/do-login', 'processLoginEmail');

        Route::get('/sign-in/{accessToken}', 'processLoginOauth');

        Route::get('/sign-up', 'register');

        Route::get('/sign-up/{accessToken}', 'processRegisterOauth');

        Route::post('/sign-up/do-register', 'processRegisterEmail');
    });

    Route::get('/sign-out', 'signOut');
});
