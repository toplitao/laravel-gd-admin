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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('user/member','User\MemberController@list');
// Route::group([['prefix' => 'user','middleware' => 'user'], function () {
//     Route::get('/member', 'User\MemberController@list');
//     Route::get('/repairer','RepairerController@list');
// });
