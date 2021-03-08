<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\DashboardController;

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
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Slider
    $prefix = 'slider';
    Route::prefix($prefix)->group(function () use($prefix) {
        Route::get('/', [SliderController::class, 'index'])->name($prefix);
    });
});
