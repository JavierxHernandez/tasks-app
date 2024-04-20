<?php
require __DIR__ . '/auth.php';
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('tasks', 'task.table')
    ->middleware(['auth'])
    ->name('task.table');

Route::view('tasks/create', 'task.create')
    ->middleware(['auth'])
    ->name('task.create');
