<?php
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Api\V1\Controllers', 'domain' => env('API_ROUTE_DOMAIN', 'localhost'),
    'middleware' => 'cors'], function ($api) {
    $api->get('auth/forceupdate', 'AuthController@forceUpdate');
    $api->post('auth/insertUser', 'AuthController@insertUser');
    $api->post('user/login', 'UserController@login');
    $api->get('user/getAuthToken', 'AuthController@getAuthToken');

//    $api->group(['middleware'=> ['api.auth','isactive','lastaccessed']], function ($api){
//        $api->get('user/', 'UserController@insertUser');
//    });

    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        $api->get('user/index', 'UserController@index');
    });
});