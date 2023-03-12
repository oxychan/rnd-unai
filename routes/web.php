<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Management\MenuManagementController;
use App\Http\Controllers\Management\RoleManagementController;
use App\Http\Controllers\Management\UserManagementController;
use App\Http\Requests\UserManagementRequest;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    return view('index');
});

Route::name('auth.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('index');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    // dashboard prefix
    Route::prefix('dashboard')->group(function () {
        Route::view('/', 'dashboard.index')->name('dashboard');

        Route::group(['prefix' => 'management', 'as' => 'management.'], function () {
            // User Management
            Route::model('user', User::class);
            Route::resource('user', UserManagementController::class);

            // Role Management
            Route::model('role', Role::class);
            Route::resource('role', RoleManagementController::class);

            // Menu Management
            Route::model('menu', Menu::class);
            Route::resource('menu', MenuManagementController::class);
        });
    });

    // logout
    Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');
});
