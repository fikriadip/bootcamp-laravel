<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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
Route::get('/',[HomeController::class,'index']);

Route::get('/register', [AuthController::class, 'dataReg'])->name('register.dataReg');
Route::post('/welcome', [AuthController::class, 'submitRegister'])->name('welcome.submit');

// Route table admin lte
Route::get('/table', function () {
    return view('table.table');
});

Route::get('/data-tables', function () {
    return view('table.data-tables');
});

Route::get('/', function () {
    return view('home');
});
// Route::get('/', [PostController::class, 'create']);

Route::get('/crud/posts', [PostController::class, 'index']); 

Route::get('/crud/posts/create', [PostController::class, 'create']); 
Route::post('/crud/posts', [PostController::class, 'store']); 

Route::get('/crud/posts/{posts_id}', [PostController::class, 'show']);

Route::get('/crud/posts/{posts_id}/edit', [PostController::class, 'edit']); 

Route::put('/crud/posts/{posts_id}', [PostController::class, 'update']); 

Route::delete('/crud/posts/{posts_id}', [PostController::class, 'destroy']); 
?>