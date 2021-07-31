<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\MapLocation;

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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index']);
// Route::get('/map', [App\Http\Livewire\MapLocation::class, 'saveLocation'])->name('map');

// Auth::routes();

// Route::get('/map', MapLocation::class);

Route::middleware('auth')->group(function() {
    Route::get('/map', MapLocation::class);
});