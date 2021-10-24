<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::get('/articles/export', [\App\Http\Controllers\ArticleController::class, 'export']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/inactive-user', [\App\Http\Controllers\HomeController::class, 'inactive'])
        ->name('user.inactive');
    Route::get('/activate-user', [\App\Http\Controllers\HomeController::class, 'activate'])
        ->name('user.activate');

    Route::get('/articles/trashed', [\App\Http\Controllers\ArticleController::class, 'trashed'])
        ->name('articles.trashed');

    Route::put('/articles/{article}/restore', [\App\Http\Controllers\ArticleController::class, 'restore'])
        ->name('articles.restore');

    Route::delete('/articles/erase/{article}', [\App\Http\Controllers\ArticleController::class, 'erase'])
        ->name('articles.erase');

    Route::resource('/articles', \App\Http\Controllers\ArticleController::class)->except(['show']);

    Route::get('/articles/{article}/download', [\App\Http\Controllers\ArticleController::class, 'download'])
        ->name('articles.download');

    Route::resource('/notifications', \App\Http\Controllers\NotificationController::class)->only(['index', 'destroy']);

    Route::resource('/featured-articles', \App\Http\Controllers\FeaturedArticleController::class)->except(['show']);

    Route::resource('/tags', \App\Http\Controllers\TagController::class)->except(['show']);

    Route::post('comments', [\App\Http\Controllers\CommentController::class, 'store'])
        ->name('comments.store');
});
Route::get('/tags/{tag}/{slug?}', [\App\Http\Controllers\TagController::class, 'show'])
    ->name('tags.show');

Route::get('/articles/{article}/{slug?}', [\App\Http\Controllers\ArticleController::class, 'show'])
    ->name('articles.show');

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


