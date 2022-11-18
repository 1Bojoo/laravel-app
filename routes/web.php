<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AnnController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResController;

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

Route::get('/', function() {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(AnnController::class)->group(function() {
        Route::get('/pages/crAnn', 'create')->name('crann');
        Route::post('/pages/crAnn', 'store');
    });

    Route::middleware(['can:isAdmin'])->group(function () {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/pages/admin/userAd', 'users')->name('users');
            Route::get('/pages/admin/createUser', 'create')->name('createUser');
            Route::post('/pages/admin/userAd', 'store')->name('storeUser');
            Route::get('/pages/admin/editUser/{user}', 'edit')->name('editUser');
            Route::post('/pages/admin/userAd/{user}', 'update')->name('updateUser');
            Route::delete('/pages/admin/userAd/{user}', 'destroy');
        });
    });
    
});

Route::controller(AnnController::class)->group(function() {
    Route::get('/pages/ann', 'index');
    Route::get('/pages/selAnn/{id}', 'selAnn')->name('selAnn');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');