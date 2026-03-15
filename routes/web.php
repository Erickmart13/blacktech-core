<?php

use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->prefix('system')
    ->name('system.')
    ->group(function () {

        Route::view('/dashboard', 'dashboard')
            ->name('dashboard');


        Route::resource('permissions', PermissionController::class);
    });
