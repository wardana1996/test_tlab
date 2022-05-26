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


Route::get('/', [App\Http\Controllers\datamasterController::class, 'indexKategori'])->name('datamasterkategori.index');
Route::post('/datamasterkategori/create', [App\Http\Controllers\datamasterController::class, 'createKategori'])->name('datamasterkategori.create');
Route::post('/datamasterkategori/edit/{id}', [App\Http\Controllers\datamasterController::class, 'editKategori'])->name('datamasterkategori.edit');
Route::post('/datamasterkategori/update/{id}', [App\Http\Controllers\datamasterController::class, 'updateKategori'])->name('datamasterkategori.update');
Route::delete('/datamasterkategori/delete/{id}', [App\Http\Controllers\datamasterController::class, 'deleteKategori'])->name('datamasterkategori.delete');

Route::get('/datamasterbahan', [App\Http\Controllers\datamasterController::class, 'indexBahan'])->name('datamasterbahan.index');
Route::post('/datamasterbahan/create', [App\Http\Controllers\datamasterController::class, 'createBahan'])->name('datamasterbahan.create');
Route::post('/datamasterbahan/edit/{id}', [App\Http\Controllers\datamasterController::class, 'editBahan'])->name('datamasterbahan.edit');
Route::post('/datamasterbahan/update/{id}', [App\Http\Controllers\datamasterController::class, 'updateBahan'])->name('datamasterbahan.update');
Route::delete('/datamasterbahan/delete/{id}', [App\Http\Controllers\datamasterController::class, 'deleteBahan'])->name('datamasterbahan.delete');

Route::get('/dataresep', [App\Http\Controllers\dataresepController::class, 'index'])->name('dataresep.index');
Route::get('/dataresep/kategori', [App\Http\Controllers\dataresepController::class, 'getKategori'])->name('dataresep.kategori');
Route::get('/dataresep/bahan', [App\Http\Controllers\dataresepController::class, 'getBahan'])->name('dataresep.bahan');
Route::post('/dataresep/create', [App\Http\Controllers\dataresepController::class, 'create'])->name('dataresep.create');
Route::post('/dataresep/edit/{id}', [App\Http\Controllers\dataresepController::class, 'edit'])->name('dataresep.edit');
Route::post('/dataresep/update/{id}', [App\Http\Controllers\dataresepController::class, 'update'])->name('dataresep.update');
Route::delete('/dataresep/delete/{id}', [App\Http\Controllers\dataresepController::class, 'delete'])->name('dataresep.delete');
