<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('test', function () {
        return 'It is ok';
    });
});
