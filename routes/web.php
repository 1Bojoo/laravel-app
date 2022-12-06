<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AnnController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResController;
use App\Http\Controllers\MainController;

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

Route::middleware(['auth', 'verified'])->group(function () {

    // OGŁOSZENIA

    Route::controller(AnnController::class)->group(function() {
        Route::get('/pages/crAnn', 'create')->name('crann');
        Route::post('/pages/crAnn', 'store');
        Route::post('/pages/selAnn/{id}', 'reservation');
    });

    // PANEL UŻYTKOWNIKA

    Route::controller(UserController::class)->group(function() {
        Route::get('pages/user/myAnn', 'showAnn')->name('myann');

        Route::get('pages/user/myAnn/{id}', 'destroyAnn')->name('delAnn');

        Route::get('pages/user/editAnn/{ann}', 'editAnn')->name('editAnn');
        Route::post('pages/user/myAnn/{ann}', 'updateAnn')->name('updateAnn');

        Route::get('pages/user/myRes', 'showRes')->name('myres');

        Route::get('pages/user/myRes/{id}', 'destroyRes')->name('delRes');

        // Route::get('pages/user/myRes/{id}', 'editRes')->name('editRes');
        // Route::post('pages/user/myRes/{id}', 'updateRes')->name('updateRes');
    });

    // PANEL ADMINISTRATORA

    Route::middleware(['can:isAdmin'])->group(function () {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/pages/admin/userAd', 'users')->name('users');
            Route::get('/pages/admin/userAnn', 'ann')->name('announcements');
            Route::get('/pages/admin/createUser', 'create')->name('createUser');
            Route::post('/pages/admin/userAd', 'store')->name('storeUser');

            Route::get('/pages/admin/editUser/{user}', 'edit')->name('editUser');
            Route::post('/pages/admin/userAd/{user}', 'update')->name('updateUser');

            Route::delete('/pages/admin/userAd/{user}', 'destroyUser')->name('destroyUser');
            Route::delete('/pages/admin/userAnn/{ann}', 'destroyAnn')->name('destroyAnn');
        });
    });
    
});

//WIDOK NIEZALOGOWANEGO UŻYTKOWNIKA

Route::controller(AnnController::class)->group(function() {
    Route::get('/', 'index')->name('ann');
    Route::get('/pages/selAnn/{id}', 'selAnn')->name('selAnn');
});

Route::get('/main', [MainController::class, 'index'])->name('main');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');