<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
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

Route::get('/', function () {
    return view('welcome');
});

// DOMPDF langsung mencetak
Route::get('/test-dompdf', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Hello World! <br> Muhammad Fikri Adi Prasetyo</h1>');
    // $pdf->loadHTML('<h1>Muhammad Fikri Adi</h1>');
    return $pdf->stream();
});

// DOMPDF dengan Controller
Route::get('/test-dompdf-2', [PdfController::class, 'TestPdf']);

// Laravel Excel
Route::get('/test-excel', [PostController::class, 'export']);