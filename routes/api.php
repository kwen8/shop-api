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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
	'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
	//获取token
	$api->post('login', 'AuthController@login');
	//注销token
	$api->post('logout', 'AuthController@logout');
	//刷新token
	$api->post('refresh', 'AuthController@refresh');

	$api->group(['middleware' => 'api.auth'], function ($api) {
		//获取管理员信息
		$api->get('admin', 'AuthController@admin');
		//  当前用户信息
		$api->get('user', 'UsersController@userShow')->name('api.user.show');

		$api->get('users', 'UsersController@index')->name('api.users.index');
		$api->get('users/{id}', 'UsersController@show')->name('api.users.show');
	});
});
