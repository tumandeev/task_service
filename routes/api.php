<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/projects/{project}/tasks', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/projects/{project}/tasks', [TaskController::class, 'search'])->name('tasks.search');

    Route::get('/tasks/{id}', [TaskController::class, 'find'])->name('task.find');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->name('task.delete');
});
