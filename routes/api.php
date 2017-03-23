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
Route::get('/express-search','Common\ExpressController@getOrderTracesByJson');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'user'], function () {
    Route::get('/member', 'User\MemberController@list');
    Route::post('/member/add', 'User\MemberController@add');
    Route::post('/member/update', 'User\MemberController@update');
    Route::get('/member/del', 'User\MemberController@del');
    Route::get('/member/search', 'User\MemberController@search');


    Route::get('/repairer', 'User\RepairerController@list');
    Route::post('/repairer/add', 'User\RepairerController@add');
    Route::post('/repairer/update', 'User\RepairerController@update');
    Route::get('/repairer/del', 'User\RepairerController@del');
    Route::get('/repairer/search', 'User\RepairerController@search');
});
