<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('create', [TasksController::class, 'create']);
        Route::post('store', [TasksController::class, 'store']);
        Route::get('{task}/edit', [TasksController::class, 'edit']);
        Route::patch('{task}', [TasksController::class, 'update']);
        Route::delete('{task}', [TasksController::class, 'destroy']);
    });
});
