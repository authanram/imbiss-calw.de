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

Route::get('/menu/{menu?}', function () {
    $category = null;

    foreach(MenuCategory::all() as $menuCategory) {
        if (urlencode(strtolower($menuCategory->name)) === request()->route()->parameter('menu')) {
            $category = $menuCategory;
        }
    }

    if ($category === null) {
        abort(404);
    }

    return view('menu', [
        'categories' => [$category],
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