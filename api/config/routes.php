<?php

declare(strict_types=1);

use App\Http\Action\V1\Market\CreateAction;
use App\Http\Action;
use App\Http\Action\V1\Market\GetAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->get('/', Action\HomeAction::class);

    $app->group('/v1', function (RouteCollectorProxy $group): void {

        $group->group('/market', function (RouteCollectorProxy $group): void {

            $group->get('/instrument', GetAction::class);
            $group->post('/instrument', CreateAction::class);
        });
    });
};
