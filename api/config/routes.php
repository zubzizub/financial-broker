<?php

declare(strict_types=1);

use Api\Http\Action;
use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (App $app) {

    $app->get('/', Action\HomeAction::class . ':handle');

    $app->get('/error', function(Request $request){
        throw new \Slim\Exception\HttpNotFoundException($request);
    });

    $app->get(
        '/api',
        function (Request $request, Response $response, $args) {

            $test = $this->get('test2');

            $response->getBody()->write(json_encode(['name' => 'api', 'version' => $test->name]));
            return $response->withHeader('Content-Type', 'application/json');
        }
    ); 
};
