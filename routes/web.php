<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CinemaCompanyController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ShowTimeController;
use App\Http\Controllers\TheatreController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::resource('/show-time', ShowTimeController::class);

});

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::resource('/cinema-company', CinemaCompanyController::class);
Route::resource('/cinema', CinemaController::class);
Route::resource('/theatre', TheatreController::class);
Route::resource('/film', FilmController::class);
//Route::resource('/booking', BookingController::class);
Route::resource('/show-time', ShowTimeController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('/booking', BookingController::class);

});

