<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;

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
Auth::routes();

Route::get('/', function () {
    return view('urlshortener');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// redirect to original url.
Route::get('/u/{any}', [UrlShortenerController::class, 'handle']);


// Store shorten url.
Route::post('/url/shorten', [UrlShortenerController::class, 'store']);


Route::get('/urls', [UrlShortenerController::class, 'getURLs']);
Route::get('/top-urls', [UrlShortenerController::class, 'topURLs']);


Route::get('/test', [UrlShortenerController::class, 'index'])->name('test');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
