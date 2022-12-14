<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('auth/save',[MainController::class,'authsave'])->name('auth.save');
Route::post('auth/check',[MainController::class,'authcheck'])->name('auth.check');
Route::get('auth.logout',[MainController::class,'logout'])->name('auth.logout');




Route::group(['middleware'=>'AuthCheck'],function (){

    Route::get('Admin.dashboard',[MainController::class,'dashboard']);
    Route::get('auth.login',[MainController::class,'login'])->name('auth.login');
    Route::get('auth.register',[MainController::class,'register'])->name('auth.register');
});