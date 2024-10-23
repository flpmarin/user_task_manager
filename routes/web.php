<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebController;

Route::get('/', [WebController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth:sanctum'])->get('/example',[DashboardController::class, 'example'])->name('example');