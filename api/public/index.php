<?php

declare(strict_types=1);

use DI\Container;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

http_response_code(500);

chdir(dirname(__DIR__));
require __DIR__ . '/../vendor/autoload.php';


$container = new Container();
$container->set('test', 'test');
$container->set(
    'test2',
    function (ContainerInterface $container) {
        $object = new stdClass();
        $object->name = 'test2';
        return $object;
    }
);

$container->set(
    \Api\Infrastructure\UppercaseInterface::class,
    function (ContainerInterface $container) {
        return new class implements \Api\Infrastructure\UppercaseInterface {
            public function modify(string $str): string
            {
                return strtoupper($str);
            }
        };
    }
);

$app = AppFactory::createFromContainer($container);

$app->addErrorMiddleware((bool)getenv('APP_DEBUG'), true, true);

(require __DIR__ . '/../config/routes.php')($app);

$app->run();
