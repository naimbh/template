<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

//auth routes
require_once('auth_routes.php');

//admin routes
Route::group(['middleware' => ['auth', 'checkAdmin']], function () {
    Route::resource('user', ProfileController::class);

    //user management
    Route::get('admins', [UserController::class, 'admins'])->name('admins');
    Route::get('users', [UserController::class, 'users'])->name('users');

    //user
    Route::post('user/bulkUpload', [UserController::class, 'bulkUpload'])->name('bulkUpload');
    Route::post('user/add', [UserController::class, 'addUser'])->name('addUser');
    Route::get('user/delete/{id}', [UserController::class, 'dltUser'])->name('dltUser');
    Route::get('user/show/{id}', [UserController::class, 'showUser'])->name('showUser');
    Route::post('user/update/{id}', [UserController::class, 'editUser'])->name('editUser');
});

//user routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::view('profile', 'backend.profile')->name('profile');

    //datatable
    Route::get('datatable/signedDocs', [DatatableController::class, 'signedDocs'])->name('datatable.signedDocs');
});


