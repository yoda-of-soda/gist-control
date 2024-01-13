<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GistController;

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

Route::get('/', [UserController::class, 'index'])->name('login.index');

Route::get('/callback', [UserController::class, 'login'])->name('login.login');

Route::get('/tokens', [UserController::class, 'tokens'])->name('login.tokens');

Route::get('/gists', [GistController::class, 'index'])->name('gist.list');

Route::get('/gists/new', [GistController::class, 'create'])->name('gist.create');

Route::get('/gists/{gist_id}/edit', [GistController::class, 'edit'])->name('gist.edit');

Route::put('/gists/{gist_id}', [GistController::class, 'update'])->name('gist.update');

Route::post('/gists/{gist_id}/delete', [GistController::class, 'delete'])->name('gist.delete');

Route::get('/gists/{gist_id}', [GistController::class, 'show'])->name('gist.show');

Route::post('/gists/{gist_id}/comments', [GistController::class, 'createComment'])->name('comment.create');

Route::get('/gists/{gist_id}/comments/{comment_id}', [GistController::class, 'editComment'])->name('comment.edit');

Route::put('/gists/{gist_id}/comments/{comment_id}', [GistController::class, 'updateComment'])->name('comment.update');

Route::delete('/gists/{gist_id}/comments/{comment_id}', [GistController::class, 'deleteComment'])->name('comment.delete');

Route::post('/gists/new', [GistController::class, 'store'])->name('gist.store');