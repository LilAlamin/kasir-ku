<?php

use App\Http\Controllers\auth;
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

Route::get('/wal', function () {
    return view('welcome');
});
Route::get('/pelanggan', function () {
    return view('tes');
});


// Auth
Route::get('/',[auth::class,'login']);
Route::post('/',[auth::class,'masuk'])->name('login');
