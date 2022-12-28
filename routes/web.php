<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::get('/dashboard/load', 'HomeController@load')->name('dashboard.load');

    //permissions
    Route::resource('permissions', PermissionController::class)->only([
        'index'
    ]);

    //roles
    Route::resource('roles', RoleController::class)->except([
        'show'
    ]);

    Route::resource('activities', 'ActivityController');
    
    Route::resource('trainers', 'TrainerController');

    Route::resource('codes', 'CodeController');

    Route::resource('users', 'UserController');

    Route::post('/users/changestatus', 'UserController@changestatus')->name('users.changestatus');

    Route::get('/active/export', 'ActivityExportController@export');
    Route::post('/active/import', 'ActivityImportController@store')->name('activity.import');

    Route::get('/iku', 'IkuController@index')->name('iku.index');
    Route::get('/iku/target', 'IkuController@target')->name('iku.target');
    Route::get('/iku/create', 'IkuController@create')->name('iku.create');
    Route::post('/iku', 'IkuController@store')->name('iku.store');
    Route::get('/iku/{id}/edit', 'IkuController@edit')->name('iku.edit');
    Route::put('/iku/{iku}', 'ikuController@update')->name('iku.update');
    Route::get('/iku/{id}', 'IkuController@detail')->name('iku.detail');
    Route::delete('/iku/{id}', 'IkuController@destroy')->name('iku.destroy');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/monitors', 'MonitorController@index')->name('monitors.index');
    Route::get('/monitors/load', 'MonitorController@load')->name('monitors.load');
    Route::get('/monitors/agenda', 'MonitorController@agenda')->name('monitors.agenda');
    Route::get('/monitors/week', 'MonitorController@week')->name('monitors.week');  
    Route::get('/extrajp', 'ExtrajpController@index')->name('extrajp.index');
    Route::get('/extrajp/detail/{id}/{month}/{year}', 'ExtrajpController@detail')->name('extrajp.detail');

    Route::get('/codes/export', 'CodesExportController@export');

    Route::get('/users/export', 'UsersExportController@export');

    Route::get('/ajax/trainers/search', 'TrainerController@ajaxSearch')->name('trainers.search');

    Route::get('/ajax/codes/search', 'CodeController@ajaxSearch')->name('codes.search');

    Route::get('/spmk', 'SpmkController@index')->name('spmk.index');
    Route::get('/spmk/{id}/edit', 'SpmkController@edit')->name('spmk.edit');
    Route::put('/spmk/{spmk}', 'SpmkController@update')->name('spmk.update');
    Route::get('/spmk/{spmk}', 'SpmkController@show')->name('spmk.show');
    Route::get('/spmk/download/{spmk}/{jenis}', 'SpmkController@download')->name('spmk.download');
    Route::post('/spmk/upload', 'SpmkController@upload')->name('spmk.upload');
});


