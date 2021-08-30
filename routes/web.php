
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

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login-submit', 'AuthController@loginSubmit')->name('login-submit');
Route::post('/logout', 'AuthController@logout')->name('z-logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('z-admin');

    Route::get('/orders', 'OrderController@index');
    Route::post('/order-status/update', 'OrderController@statusUpdate')->name('order-update-status');
    Route::get('/order-detail/{order_number}', 'OrderController@detail')->name('order-detail');

    Route::get('/members', 'MemberController@index');
    Route::post('/member-status/update', 'MemberController@statusUpdate')->name('member-update-status');
});