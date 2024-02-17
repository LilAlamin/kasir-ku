<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth;
use App\Http\Controllers\KasirController;
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





// Auth
Route::get('/',[auth::class,'login']);
Route::post('/',[auth::class,'masuk'])->name('login');
Route::get('/logout',[auth::class,'logout']);


// kasir
Route::get('/kasir',[KasirController::class,'index'])->name('kasir.index');


// Admin

Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
Route::get('/admin/kasir',[AdminController::class,'kasir'])->name('admin.kasir');