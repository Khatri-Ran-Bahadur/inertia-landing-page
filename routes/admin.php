<?php

use App\Http\Controllers\Admin\AboutUsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StaticController;
use App\Http\Controllers\Admin\TranslationController;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'web']], function () {
    Route::get('dashboard', function () {
        return inertia('Admin/Dashboard');
    })->name('dashboard');

    Route::group(['as' => 'profile.'], function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('edit');
            Route::patch('/profile', 'update')->name('update');
            Route::delete('/profile', 'destroy')->name('destroy');
        });
    });

    /**
     * Settigns
     */
    Route::controller(SettingController::class)->group(function () {
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', 'index')->name('index');
            Route::post('update', 'update')->name('update');
            Route::get('cache-clear', 'cache_clear')->name('cache-clear');
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        });
    });

    /**
     * Services
     */
    Route::controller(ServiceController::class)->group(function () {
        Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
            Route::get('change-status/{id}',  'change_status')->name('change-status');
            Route::post('bulk-action',  'bulk_action')->name('bulk-action');
            Route::post('restore/{id}',  'restore')->name('restore');
            Route::delete('permanently-delete/{id}',  'delete')->name('delete');
        });
    });

    /**
     * About us
     */
    Route::controller(AboutUsController::class)->group(function () {
        Route::group(['prefix' => 'aboutus', 'as' => 'aboutus.'], function () {
            Route::get('change-status/{id}',  'change_status')->name('change-status');
            Route::post('bulk-action',  'bulk_action')->name('bulk-action');
            Route::post('restore/{id}',  'restore')->name('restore');
            Route::delete('permanently-delete/{id}',  'delete')->name('delete');
        });
    });

    Route::controller(StaticController::class)->group(function () {
        Route::group(['prefix' => 'static-section', 'as' => 'static-section.'], function () {
            Route::get('/', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
    });



    Route::resources([
        'users' => UserController::class,
        'services' => ServiceController::class,
        'aboutus' => AboutUsController::class,
        'translations' => TranslationController::class,
    ]);
});

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
