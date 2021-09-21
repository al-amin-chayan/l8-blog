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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/articles/trashed', [\App\Http\Controllers\ArticleController::class, 'trashed'])
        ->name('articles.trashed');

    Route::put('/articles/{article}/restore', [\App\Http\Controllers\ArticleController::class, 'restore'])
        ->name('articles.restore');

    Route::delete('/articles/erase/{article}', [\App\Http\Controllers\ArticleController::class, 'erase'])
        ->name('articles.erase');

    Route::resource('/articles', \App\Http\Controllers\ArticleController::class);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
