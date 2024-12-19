<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;


Route::get('/', [IssueController::class, 'index'])->name('issue.index');

Route::get('/issue/create', [IssueController::class, 'create'])->name('issue.create');

Route::post('/issue', [IssueController::class, 'store'])->name('issue.store');

Route::get('/issue/{issue}/edit', [IssueController::class, 'edit'])->name('issue.edit');

Route::put('/issue/{issue}', [IssueController::class, 'update'])->name('issue.update');

Route::delete('/issue/{issue}', [IssueController::class, 'destroy'])->name('issue.destroy');
