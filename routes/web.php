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
// admin Kasir
Route::get('/admin/kasir',[AdminController::class,'kasir'])->name('admin.kasir');
Route::get('/admin/kasir/create',[AdminController::class,'create_kasir'])->name('admin.create_kasir');
Route::post('/admin/kasir',[AdminController::class,'store_kasir'])->name('admin.store_kasir');
Route::get('/admin/edit-kasir/{id}', [AdminController::class, 'edit_kasir'])->name('admin.edit_kasir');
Route::put('/admin/update-kasir/{id}', [AdminController::class, 'update_kasir'])->name('admin.update_kasir');
Route::get('/admin/kasir/{id}/delete', [AdminController::class, 'destroy_kasir'])->name('admin.destroy_kasir');

// admin produk
Route::get('/produk',[AdminController::class,'product'])->name('admin.produk');
Route::get('/produk/create',[AdminController::class,'create_product'])->name('admin.produk_create');
Route::post('/produk',[AdminController::class,'store_product'])->name('admin.produk_store');
Route::get('/produk/edit-produk/{id}',[AdminController::class,'edit_product'])->name('admin.produk_edit');
Route::put('/produk/update-produk/{id}',[AdminController::class,'update_product'])->name('admin.produk_update');
Route::get('/produk/{id}/delete', [AdminController::class, 'destroy_product'])->name('admin.destroy_produk');


