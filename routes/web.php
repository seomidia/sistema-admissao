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

Route::get('/admissao/{admission}/solicitacao',[App\Http\Controllers\AdmissionController::class,'index'])->name('admission-form');
Route::post('/admissao/{admission}/solicitacao',[App\Http\Controllers\AdmissionController::class,'store'])->name('admission-form.store');
Route::get('/admissao/{admission}/imprimir',[App\Http\Controllers\AdmissionController::class,'print'])->name('admission-form.print');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
