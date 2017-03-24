<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::get('user/member','User\MemberController@list')->middleware('auth:api');

Route::group(['prefix' => 'common','namespace'=>'Common'], function () {
    Route::get('/express-search','ExpressController@getOrderTracesByJson');
    Route::post('/file-upload','FileController@uploads');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user','namespace'=>'User'], function () {
    Route::get('/member', 'MemberController@list');
    Route::post('/member/add', 'MemberController@add');
    Route::post('/member/update', 'MemberController@update');
    Route::get('/member/del', 'MemberController@del');
    Route::get('/member/search', 'MemberController@search');


    Route::get('/repairer', 'RepairerController@list');
    Route::post('/repairer/add', 'RepairerController@add');
    Route::post('/repairer/update', 'RepairerController@update');
    Route::get('/repairer/del', 'RepairerController@del');
    Route::get('/repairer/search', 'RepairerController@search');
});

Route::group(['prefix' => 'goods','namespace'=>'Goods'], function () {
    Route::get('', 'GoodsController@list');
    Route::post('/add', 'GoodsController@add');
    Route::post('/update', 'GoodsController@update');
    Route::get('/del', 'GoodsController@del');
    Route::get('/search', 'GoodsController@search');
});
Route::group(['prefix' => 'order'], function () {
    Route::get('/list', 'Order\OrderController@list');
    Route::post('/list/add', 'Order\OrderController@add');
    Route::post('/list/update', 'Order\OrderController@update');
    Route::get('/list/del', 'Order\OrderController@del');
    Route::get('/list/search', 'Order\OrderController@search');


    // Route::get('/repairer', 'User\RepairerController@list');
    // Route::post('/repairer/add', 'User\RepairerController@add');
    // Route::post('/repairer/update', 'User\RepairerController@update');
    // Route::get('/repairer/del', 'User\RepairerController@del');
    // Route::get('/repairer/search', 'User\RepairerController@search');
});


Route::group(['prefix' => 'fitting'], function () {
    Route::get('/list', 'Fitting\FittingController@list');
    Route::post('/list/add', 'Fitting\FittingController@add');
    Route::post('/list/update', 'Fitting\FittingController@update');
    Route::get('/list/del', 'Fitting\OFittingController@del');
    Route::get('/list/search', 'Fitting\FittingController@search');


    // Route::get('/repairer', 'User\RepairerController@list');
    // Route::post('/repairer/add', 'User\RepairerController@add');
    // Route::post('/repairer/update', 'User\RepairerController@update');
    // Route::get('/repairer/del', 'User\RepairerController@del');
    // Route::get('/repairer/search', 'User\RepairerController@search');
});

