<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'],function () {
    Route::post('/login',[UserController::class,'login']);
});

Route::group(['prefix' => 'task','middleware' => 'auth:api'],function () {
    Route::get('/filter',[TaskController::class,'filter']);
    Route::get('/filter',[TaskController::class,'filter']);
    Route::post('/upsert',[TaskController::class,'upsertTask']);
    Route::post('/toggle-assign',[TaskController::class,'toggleAssignUser']);
    Route::post('/status',[TaskController::class,'changeStatus']);
});

Route::group(['prefix' => 'thread','middleware' => 'auth:api'],function () {
    Route::post('/upsert',[ThreadController::class,'upsertThread']);
    Route::post('/complete-toggle',[ThreadController::class,'setThreadComplete']);
});