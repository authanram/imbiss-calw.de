<?php

use App\MenuCategory;

//Auth::routes();

Route::get('/', function () {
    return view('welcome', [
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

Route::get('/menu/{menu}', function ($menu) {
    $categories = MenuCategory::all();

    foreach($categories as $menuCategory) {
        if (urlencode(strtolower($menuCategory->name)) === $menu) {
            $categories = [$menuCategory];
        }
    }

    return view('menu', [
        'categories' => $categories,
    ]);
})->name('menu.menu');

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::resource('admin/roles', 'Admin\RolesController');
    Route::resource('admin/permissions', 'Admin\PermissionsController');
    Route::resource('admin/users', 'Admin\UsersController');
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'editor'], function () {
    Route::get('admin', 'Admin\AdminController@index');
    Route::resource('menu-categories', 'MenuCategoriesController');
    Route::resource('menus', 'MenusController');
});