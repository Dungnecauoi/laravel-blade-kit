<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UiKitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LocaleController;
use Duxbo\LaravelAuth\Models\Permission;
use Duxbo\LaravelAuth\Models\Role;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

Route::get('locale/{locale}', LocaleController::class)->name('locale');

// Public marketing page demo — uses x-layouts.guest, separate from the admin.* group below.
Route::view('landing', 'admin.landing')->name('landing');

// 'admin.auth' is a neutral alias registered by duxbo/laravel-core (a
// pass-through by default) — installing a real auth package overrides it,
// which is what actually turns login enforcement on for these routes.
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('ui-kit', UiKitController::class)->name('ui-kit');
    Route::view('settings', 'admin.settings')->name('settings');
    Route::view('inventory', 'admin.inventory')->name('inventory');
    Route::view('orders/1082', 'admin.orders.show')->name('orders.show');
    Route::view('invoice', 'admin.invoice')->name('invoice');

    // Requires `composer require duxbo/laravel-auth` — every route here is
    // gated by Laravel's own `can:` middleware against RolePolicy/
    // PermissionPolicy/UserPolicy (registered by that package's provider);
    // a super-admin role (Gate::before) bypasses all of it. {user} is bound
    // explicitly since the User model is only known at runtime via config.
    Route::model('user', config('laravel-auth.user_model', \App\Models\User::class));

    $userModelClass = config('laravel-auth.user_model', \App\Models\User::class);

    Route::get('users', [UserController::class, 'index'])->middleware("can:viewAny,{$userModelClass}")->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->middleware("can:create,{$userModelClass}")->name('users.create');
    Route::post('users', [UserController::class, 'store'])->middleware("can:create,{$userModelClass}")->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('can:update,user')->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('can:update,user')->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('can:delete,user')->name('users.destroy');

    Route::get('roles', [RoleController::class, 'index'])->middleware('can:viewAny,'.Role::class)->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->middleware('can:create,'.Role::class)->name('roles.create');
    Route::post('roles', [RoleController::class, 'store'])->middleware('can:create,'.Role::class)->name('roles.store');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('can:update,role')->name('roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->middleware('can:update,role')->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('can:delete,role')->name('roles.destroy');

    Route::get('permissions', [PermissionController::class, 'index'])->middleware('can:viewAny,'.Permission::class)->name('permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->middleware('can:create,'.Permission::class)->name('permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->middleware('can:create,'.Permission::class)->name('permissions.store');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->middleware('can:update,permission')->name('permissions.edit');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->middleware('can:update,permission')->name('permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('can:delete,permission')->name('permissions.destroy');
});

Route::prefix('errors-demo')->name('errors-demo.')->group(function () {
    Route::view('404', 'admin.errors.404')->name('404');
    Route::view('403', 'admin.errors.403')->name('403');
    Route::view('500', 'admin.errors.500')->name('500');
});
