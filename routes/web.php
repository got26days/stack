<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostLinkController;
use App\Http\Controllers\TagController;
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

Route::get('/test', [MainController::class, 'test']);

Route::get('/', [PostController::class, 'index']);
Route::get('/questions', [PostController::class, 'index'])->name('questions');
Route::get('/questions/tagged/{tags}', [PostController::class, 'tagged'])->name('tagged_questions');
Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::get('/tags/search', [TagController::class, 'search'])->name('tags.search');
Route::get('/users', [UserController::class, 'index'])->name('users');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
