<?php

use Src\Task\Infrastructure\Controller\TaskDeleteController;
use Src\Task\Infrastructure\Controller\TaskGetController;
use Src\Task\Infrastructure\Controller\TaskPostController;
use Src\Task\Infrastructure\Controller\TaskPutController;

Route::get('/{id}', [TaskGetController::class, 'getTask']);
Route::get('/', [TaskGetController::class, 'getAllTasks']);
Route::get('/create', [TaskPostController::class, 'create']);
Route::get('/update/{id}', [TaskPutController::class, 'update']);
Route::get('/delete/{id}', [TaskDeleteController::class, 'delete']);
