<?php

use App\Libraries\Helpers;
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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get/highlight', 'HomeController@getDashboardHighlight')->name('dashboard.highlight');
Route::get('/get/{type?}', 'HomeController@getDashboardData')->name('dashboard');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('create_request_form', 'Admin\CreateRequestFormController');
    Route::post('create_request_form_send', 'Admin\CreateRequestFormController@send')->name('create_request_form.send');
    Route::post('create_request_form_send_cancel', 'Admin\CreateRequestFormController@send_cancel')->name('create_request_form.send_cancel');
    Route::post('create_request_form_ttd', 'Admin\CreateRequestFormController@ttd')->name('create_request_form.ttd');
    Route::resource('user', 'Admin\UserController');
    Route::resource('location', 'Admin\LocationController');
    Route::resource('purpose', 'Admin\PurposeController');
    Route::resource('type_access', 'Admin\TypeAccessController');
    Route::resource('type_connection', 'Admin\TypeConnectionController');
    Route::resource('detail_access', 'Admin\DetailConnectionController');
    Route::resource('detail_connection', 'Admin\DetailAccessController');

    Route::get('notifications', 'Admin\NotificationController@index')->name('notification.index');

    // Detail Connection
    Route::post('/detailconnection-create', 'Admin\DetailConnectionController@store')->name('detailconnection.store');
    Route::post('/detailconnection-update', 'Admin\DetailConnectionController@update')->name('detailconnection.update');
    Route::delete('detailconnection-delete', 'Admin\DetailConnectionController@destroy')->name('detailconnection.destroy');

    // Detail Access
    Route::post('/detailaccess-create', 'Admin\DetailAccessController@store')->name('detailaccess.store');
    Route::post('/detailaccess-update', 'Admin\DetailAccessController@update')->name('detailaccess.update');
    Route::delete('detailaccess-delete', 'Admin\DetailAccessController@destroy')->name('detailaccess.destroy');
    // Print Surat
    Route::get('cetak-surat/{id}', 'Admin\CreateRequestFormController@print')->name('create_request_form.print');

    // My Profile
    Route::get('profile', 'Admin\ProfileController')->name('profile.index');
    Route::put('profile', 'Admin\ProfileController@update')->name('profile.update');
});
