<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\diaryController;
use App\Http\Controllers\authenticationController;

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
Route::get('/', function () {
    return view('diary.welcome');
})->name('home');
//for checkoutController
Route::get('pay',[checkoutController::class,'check_account_number'])->name('pay');
Route::get('pay',[checkoutController::class,'receipt'])->name('receipt');
Route::get('pay',[checkoutController::class,'send'])->name('send');
// for diaryController
Route::post('trash/restore',[diaryController::class,'restoreTrash'])->name('diary.trash.restore');
Route::delete('trash/delete',[diaryController::class,'deleteTrash'])->name('diary.trash.delete');
Route::get('trash',[diaryController::class,'trash'])->name('diary.trash');
Route::post('store',[diaryController::class,'store'])->name('diary.store');
Route::get('create',[diaryController::class,'create'])->name('diary.create');
Route::get('index',[diaryController::class,'index'])->name('diary.index');
Route::get('diary/profile',[diaryController::class,'profile'])->name('diary.profile');
Route::get('view',[diaryController::class,'view'])->name('diary.view');
Route::get('search',[diaryController::class,'search'])->name('diary.search');
Route::delete('delete',[diaryController::class,'delete'])->name('diary.delete');
Route::post('share',[diaryController::class,'send'])->name('diary.send');
//authentication
Route::post('auth/register',[authenticationController::class,'register'])->name('auth.register');
Route::get('register',[authenticationController::class,'create'])->name('auth.create');
Route::post('auth/logout',[authenticationController::class,'logout'])->name('auth.logout');
Route::get('login',[authenticationController::class,'signin'])->name('login');
Route::post('auth/login',[authenticationController::class,'login'])->name('auth.login');



