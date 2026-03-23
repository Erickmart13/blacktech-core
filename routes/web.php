<?php

use App\Http\Controllers\Admin\MasterData\StatusApplicationController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\MasterData\StatusController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\RoleController;
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
                Route::resource('resources', ResourceController::class);
                Route::resource('permissions', PermissionController::class);
                Route::resource('roles', RoleController::class);

                Route::prefix('master-data')
                    ->name('master-data.')
                    ->group(function () {

                        Route::view('/', 'admin.master-data.index')
                            ->name('index');

                        Route::resource('statuses', StatusController::class);
                        Route::resource('status-applications', StatusApplicationController::class);
                    });
            });
    });
