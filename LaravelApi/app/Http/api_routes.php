<?php
$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['namespace'=>'App\Api\V1\Controllers','domain'=> env('API_ROUTE_DOMAIN','localhost'),
'middleware'=>'cors'],function($api){
    $api->get('forceupdate', 'AuthController@forceUpdate');
});