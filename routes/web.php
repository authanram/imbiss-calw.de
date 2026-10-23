<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuCategoriesController;
use App\Http\Controllers\MenusController;
use App\Models\MenuCategory;

// Auth::routes();

Route::get('/', function () {
    return view('menu', [
        'categories' => MenuCategory::all(),
    ]);
})->name('welcome');

Route::get('/impressum', function () {
    return view('impressum');
})->name('imprint');

Route::get('/datenschutzerklaerung', function () {
    return view('data-policies');
})->name('data-policies');

Route::get('/haftungsausschluss', function () {
    return view('disclaimer');
})->name('disclaimer');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::resource('admin/roles', RolesController::class);
    Route::resource('admin/permissions', PermissionsController::class);
    Route::resource('admin/users', UsersController::class);
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'editor'], function () {
    Route::get('admin', [AdminController::class, 'index']);
    Route::resource('menu-categories', MenuCategoriesController::class);
    Route::resource('menus', MenusController::class);
});

Route::get('/foobar', function () {
    return 'Foobar!!1^';
})->name('imprint');
