<?php

use Src\Category\Infrastructure\Controller\CategoryDeleteController;
use Src\Category\Infrastructure\Controller\CategoryGetController;
use Src\Category\Infrastructure\Controller\CategoryPostController;
use Src\Category\Infrastructure\Controller\CategoryPutController;

Route::get('/{id}', [CategoryGetController::class, 'getCategory']);
Route::get('/', [CategoryGetController::class, 'getAllCategories']);
Route::get('/create', [CategoryPostController::class, 'create']);
Route::get('/update/{id}', [CategoryPutController::class, 'update']);
Route::get('/delete/{id}', [CategoryDeleteController::class, 'delete']);
