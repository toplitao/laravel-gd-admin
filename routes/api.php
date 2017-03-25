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
    Route::get('/express-code-search','ExpressController@search');
    Route::get('/express-search','ExpressController@getOrderTracesByJson');
    Route::post('/file-uploads','FileController@uploads');
    Route::post('/file-delete','FileController@delete');
    Route::post('/file-upload','FileController@froalaEditor');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user','namespace'=>'User'], function () {
    Route::get('/member', 'MemberController@lists');
    Route::post('/member/add', 'MemberController@add');
    Route::post('/member/update', 'MemberController@update');
    Route::get('/member/del', 'MemberController@del');
    Route::get('/member/search', 'MemberController@search');


    Route::get('/repairer', 'RepairerController@lists');
    Route::post('/repairer/add', 'RepairerController@add');
    Route::post('/repairer/update', 'RepairerController@update');
    Route::get('/repairer/del', 'RepairerController@del');
    Route::get('/repairer/search', 'RepairerController@search');
    Route::get('/repairer/distribution', 'RepairerController@distribution');
});

Route::group(['prefix' => 'goods','namespace'=>'Goods'], function () {
    Route::get('', 'GoodsController@lists');
    Route::post('/add', 'GoodsController@add');
    Route::post('/update', 'GoodsController@update');
    Route::get('/del', 'GoodsController@del');
    Route::get('/search', 'GoodsController@search');
});
Route::group(['prefix' => 'order'], function () {
    Route::get('/list', 'Order\OrderController@lists');
    Route::get('/list/readorder', 'Order\OrderController@readorder');
    Route::get('/list/search', 'Order\OrderController@search');
    Route::get('/list/selectedrepairer', 'Order\OrderController@selectedrepairer');

    // Route::get('/repairer', 'User\RepairerController@list');
    // Route::post('/repairer/add', 'User\RepairerController@add');
    // Route::post('/repairer/update', 'User\RepairerController@update');
    // Route::get('/repairer/del', 'User\RepairerController@del');
    // Route::get('/repairer/search', 'User\RepairerController@search');
});


Route::group(['prefix' => 'fitting'], function () {
    Route::get('/list', 'Fitting\FittingController@lists');
    Route::post('/list/add', 'Fitting\FittingController@add');
    Route::post('/list/update', 'Fitting\FittingController@update');
    Route::get('/list/del', 'Fitting\OFittingController@del');
    Route::get('/list/search', 'Fitting\FittingController@search');
    Route::get('/list/fittinglog', 'Fitting\FittingController@fittinglog');


    // Route::get('/repairer', 'User\RepairerController@list');
    // Route::post('/repairer/add', 'User\RepairerController@add');
    // Route::post('/repairer/update', 'User\RepairerController@update');
    // Route::get('/repairer/del', 'User\RepairerController@del');
    // Route::get('/repairer/search', 'User\RepairerController@search');
});



Route::group(['prefix' => 'information','namespace'=>'Information'], function () {
    Route::get('/station', 'StationController@lists');
    Route::post('/station/add', 'StationController@add');
    Route::post('/station/update', 'StationController@update');
    Route::get('/station/del', 'StationController@del');
    Route::get('/station/search', 'StationController@search');
});

