
<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [PostController::class, 'index']); 

// Route::get('/crud/posts', [PostController::class, 'index']); 

// Route::get('/crud/posts/create', [PostController::class, 'create']); 
// Route::post('/crud/posts', [PostController::class, 'store']); 

// Route::get('/crud/posts/{posts_id}', [PostController::class, 'show']);

// Route::get('/crud/posts/{posts_id}/edit', [PostController::class, 'edit']); 

// Route::put('/crud/posts/{posts_id}', [PostController::class, 'update']); 

// Route::delete('/crud/posts/{posts_id}', [PostController::class, 'destroy']); 

Route::resource('crudposts', PostController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
