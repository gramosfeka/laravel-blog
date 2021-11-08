<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::redirect('/', '/login')->name('index');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category');

Route::prefix('categories')->middleware('is_admin')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});


Route::prefix('tags')->middleware('is_admin')->group(function(){
    Route::get('/', [TagController::class, 'index'])->name('tags.index');
    Route::post('/store', [TagController::class, 'store'])->name('tags.store');
    Route::get('/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/{id}/update', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/{id}/destroy', [TagController::class, 'destroy'])->name('tags.destroy');
});

Route::prefix('articles')->group(function(){
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/{id}/show', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::get('/{id}/approve', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::put('/{id}/update/', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/{id}/destroy', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

Route::prefix('comments')->group(function () {
    Route::post('/{post_id}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/{id}/update', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/{id}/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');
});
