<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsetController;

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

Route::get('/', function () {
    return view('auth.login');
})->middleware("validateTokenInvalid");

Route::post('login', [UserController::class,'login']);
Route::get('dashboard', [AsetController::class,'dashboard'])->middleware("validateToken");
Route::get('logout', [UserController::class,'logout'])->middleware("validateToken");
Route::post('reset-password', [UserController::class,'resetPassword'])->middleware("validateToken");

Route::get('aset', [AsetController::class,'index'])->middleware("validateToken");
Route::get('aset/delete/{id}', [AsetController::class,'delete'])->middleware("validateToken");
Route::post('aset/laporan/', [AsetController::class,'reportProcess'])->middleware("validateToken");
Route::get('aset/laporan/', [AsetController::class,'report'])->middleware("validateToken");
Route::get('aset/{id}', [AsetController::class,'detail'])->middleware("validateToken");
Route::get('aset/edit/{id}', [AsetController::class,'edit'])->middleware("validateToken");
Route::post('aset/{id}', [AsetController::class,'update'])->middleware("validateToken");
