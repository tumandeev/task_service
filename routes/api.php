<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/projects/{project}/tasks', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/projects/{project}/tasks', [TaskController::class, 'list'])->name('tasks.list');

    Route::get('/tasks/{taskId}', [TaskController::class, 'show'])->name('task.show');
    Route::put('/tasks/{taskId}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/{taskId}', [TaskController::class, 'delete'])->name('task.delete');
});
