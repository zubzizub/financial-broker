<?php

declare(strict_types = 1);

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(false, true, true);

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write('{hello!}');
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
