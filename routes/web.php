<?php

use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->group(function () {

        Route::view('/dashboard', 'dashboard')
            ->name('dashboard');

        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {

                Route::resource('modules', ModuleController::class);
            });
    });
