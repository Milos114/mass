<?php

use App\Http\Controllers\DataImportController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'user_management:user-management']], static function () {
    Route::resource('users', UserController::class)->except('show');
    Route::resource('permissions', PermissionController::class)->except('show');

    Route::get('import', [DataImportController::class, 'index'])->name('import.index');
    Route::post('import', [DataImportController::class, 'store'])->name('import.store');

    Route::get('get-data', [DataImportController::class, 'getData'])->name('get.data');
});
