<?php

use App\Http\Controllers\Admin\QuestionCrudController;
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

Route::get('/test', [MainController::class, 'index']);

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/questions/tagged/{tags?}', [PostController::class, 'tagged'])->name('tagged_questions');
Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::get('/tags/search', [TagController::class, 'search'])->name('tags.search');
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{user}/{name}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
Route::get('/cpu', [MainController::class, 'total_ram_cpu_usage'])->name('cpu');
Route::get('/search', [MainController::class, 'search'])->name('search');

Route::get('/questions', [PostController::class, 'index'])->name('questions');

Route::get('/questions/{question}/{slug}', [PostController::class, 'show'])->name('question');

// Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'login' => false]);

Route::post('/fetch/tag', [QuestionCrudController::class, 'fetchTag']);
Route::post('/fetch/user', [QuestionCrudController::class, 'fetchUser']);
