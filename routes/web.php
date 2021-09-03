
<?php

use App\Http\Controllers\ProductController;
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
    
    Route::get('/member-level', 'MemberLevelController@index')->name('member-level-index');
    Route::post('/member-level-status/update', 'MemberLevelController@statusUpdate')->name('member-level-update-status');
    Route::get('/member-level-detail/{id}', 'MemberLevelController@detail')->name('member-level-detail');
    Route::post('/member-level/update/{id}', 'MemberLevelController@update')->name('member-level-update');
    Route::get('/member-level/create', 'MemberLevelController@create')->name('member-level-create');
    Route::post('/member-level/store', 'MemberLevelController@store')->name('member-level-store');
    
    Route::get('/members', 'MemberController@index');
    Route::post('/member-status/update', 'MemberController@statusUpdate')->name('member-update-status');
    Route::post('/member-level/update', 'MemberController@levelUpdate')->name('member-update-level');
    Route::get('/member-detail/{id}', 'MemberController@detail')->name('member-detail');
    Route::post('/member-profile/update/{id}', 'MemberController@profileUpdate')->name('member-update-profile');
    Route::post('/member-reward-money/update/{id}', 'MemberController@rewardMoneyUpdate')->name('member-update-reward-money');
    
    Route::get('/orders', 'OrderController@index');
    Route::post('/order-status/update', 'OrderController@statusUpdate')->name('order-update-status');
    Route::get('/order-detail/{order_number}', 'OrderController@detail')->name('order-detail');
    Route::post('/order-message/store', 'OrderController@messageStore')->name('order-message-store');
    Route::post('/order-return-confirm', 'OrderController@returnConfirm')->name('order-return-confirm');

    Route::get('/products', 'ProductController@index')->name('product-index');
    Route::post('/product-status/update', 'ProductController@statusUpdate')->name('product-update-status');
    Route::get('/product/create', 'ProductController@create')->name('product-create');
    Route::post('/product-store', 'ProductController@store')->name('product-store');
    Route::get('/product-detail/{id}', 'ProductController@detail')->name('product-detail');
    Route::post('/product-img-delete', 'ProductController@imgDelete')->name('product-img-delete');
    Route::post('/product-sort-update', 'ProductController@sortUpdate')->name('product-sort-update');
    Route::post('/product-update', 'ProductController@productUpdate')->name('product-update');

    Route::get('/coupon', 'CouponController@index')->name('coupon-index');
    Route::post('/coupon-status/update', 'CouponController@statusUpdate')->name('coupon-update-status');
    Route::get('/coupon-detail/{id}', 'CouponController@detail')->name('coupon-detail');
    Route::post('/coupon/update/{id}', 'CouponController@update')->name('coupon-update');
    Route::get('/coupon/create', 'CouponController@create')->name('coupon-create');
    Route::post('/coupon/store', 'CouponController@store')->name('coupon-store');

    Route::get('/messages', 'MessageController@index')->name('message-index');
    Route::post('/message-status/update', 'MessageController@statusUpdate')->name('message-update-status');
    Route::get('/message-detail/{id}', 'MessageController@detail')->name('message-detail');
    Route::post('/message/update/{id}', 'MessageController@update')->name('message-update');
});