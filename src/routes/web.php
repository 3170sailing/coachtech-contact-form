<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');
Route::get('/admin/search', [AdminController::class, 'search']);
Route::delete('/admin/delete', [AdminController::class, 'destroy']);
Route::post('/login', [LoginController::class, 'login']);