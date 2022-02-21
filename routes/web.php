<?php

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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

//目標の一覧
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//目標の作成
Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
//目標の登録
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
//目標の編集
Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
//目標の更新
Route::post('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
//目標の削除
Route::post('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');

});