<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])
    ->name('tasks.toggleStatus');

Route::resource('tasks', TaskController::class);