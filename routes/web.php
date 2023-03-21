<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AnnController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MailController;

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
        Route::post('/dorm/roomRes/{id}', 'reservation')->name('res');
        Route::post('/dorm/guestRoomRes/{id}', 'guestReservation')->name('guestRes');
        // Route::get('/pages/selAnn/{id}/fetch-res', 'fetchRes')->name('fRes');
    });

    // PANEL UŻYTKOWNIKA

    Route::controller(UserController::class)->group(function() {

        Route::get('myReservation', 'showRes')->name('myres');

        Route::get('myReservation/delReservation/{id}', 'destroyRes')->name('delRes');

        Route::post('/generateQR', 'genQR')->name('generateQR');

        // Route::get('pages/user/myRes/{id}', 'editRes')->name('editRes');
        // Route::post('pages/user/myRes/{id}', 'updateRes')->name('updateRes');
    });

    // PANEL ADMINISTRATORA

    Route::middleware(['can:isAdmin'])->group(function () {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/managementPanel', 'manPanel')->name('manPanel');
            Route::get('/managementPanel/userRes', 'res')->name('manRes');
            Route::get('/managementPanel/userRes/delete/{roomID}', 'deleteRes')->name('deleteRes');
            Route::post('/managementPanel/userRes/edit/{resID}', 'editRes')->name('editRes');

            Route::get('/managementPanel/rooms', 'room')->name('roomMan');
            Route::get('/managementPanel/rooms/editStatus/{roomNum}', 'editRoom')->name('editRoom');


            Route::get('/managementPanel/users', 'users')->name('users');

            Route::get('/managementPanel/createUser', 'create')->name('createUser');
            Route::post('/managementPanel/addUser', 'store')->name('storeUser');

            Route::get('/managementPanel/editUser/{user}', 'edit')->name('editUser');
            Route::post('/managementPanel/updateUser/{user}', 'update')->name('updateUser');

            Route::delete('/managementPanel/deleteUser/{user}', 'destroyUser')->name('destroyUser');
            Route::delete('/managementPanel/userAnn/{ann}', 'destroyAnn')->name('destroyAnn');
        });

        Route::get('/dorm/img/{imageID}', [AnnController::class, 'delImage'])->name('delImg');
        Route::post('/dorm/img', [AnnController::class, 'addImage'])->name('addImage');

        Route::get('/pages/crAnn', [AnnController::class, 'create'])->name('crann');
        Route::post('/pages/crAnn', [AnnController::class, 'store']);

        Route::get('/news/{id}', [AnnController::class, 'deleteNews'])->name('delNews');
        Route::post('/news/addNews', [AnnController::class, 'addNews'])->name('addNews');

    });
    
});

//WIDOK NIEZALOGOWANEGO UŻYTKOWNIKA

Route::controller(AnnController::class)->group(function() {
    Route::get('/', 'index')->name('main');
    Route::get('/dorm', 'dormitory')->name('dorm');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/rules', 'rules')->name('rules');
    Route::get('/news', 'news')->name('news');
    Route::post('/contact/sendMail', 'contactForm')->name('contactForm');
});

Route::post('/validateQR', [UserController::class, 'qrLogin'])->name('validateQR');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');