<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$prefixAdmin = Config::get('exam.url.prefix_admin', 'default');;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix($prefixAdmin)->group(function () {
    Route::get('users', function () {
        return "/admin/users";
    });

    Route::prefix('slider')->group(function () {
        Route::get('', function () {
            return "slider list";
        });

        Route::get('edit/{id}', function ($id) {
            return "slider edit" . $id;
        })->where('id', '[0-9]+');

        Route::get('delete/{id}', function ($id) {
            return "delete id" . $id;
        })->where('id', '[0-9]+');
    });

    Route::get('category', function () {
        return "/admin/category";
    });
});
