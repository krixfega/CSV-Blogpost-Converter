<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::get('/', [BlogController::class, 'index']);
Route::get('/upload', [BlogController::class, 'showUploadForm']);
Route::post('/upload', [BlogController::class, 'uploadFile']);
Route::get('/posts/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/posts/{id}/edit', [BlogController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [BlogController::class, 'update'])->name('posts.update');
Route::get('/blog/{post}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::patch('/blog/edit', [BlogController::class, 'update'])->name('blog.update');
