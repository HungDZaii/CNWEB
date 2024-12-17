<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, "index"])->name('Post.index');

Route::get('/create', [PostController::class, "create"])->name('Post.create');

Route::post('/', [PostController::class, "store"])->name('Post.store');

Route::get('/Post/{id}/edit', [PostController::class, "edit"])->name('Post.edit');

Route::put('/Post/{id}', [PostController::class, "update"])->name('Post.update');

Route::delete('/Post/{id}', [PostController::class, "destroy"])->name('Post.destroy');