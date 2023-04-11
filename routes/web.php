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
use App\Http\Controllers\ShortLinkController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('generate-shorten-link', [ShortLinkController::class, 'index']);
Route::post('generate-shorten-link', [ShortLinkController::class, 'store'])->name('generate.shorten.link.post');

Route::get('generate-shorten-link-json', [ShortLinkController::class, 'indexJson']);
Route::post('generate-shorten-link-json', [ShortLinkController::class, 'storeJson']);

Route::get('{code}', [ShortLinkController::class, 'shortenLink'])->name('shorten.link');
