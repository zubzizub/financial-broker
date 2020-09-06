<?php

declare(strict_types=1);

use App\Http\Action\V1\Market\InstrumentCreateAction;
use App\Http\Action;
use App\Http\Action\V1\Market\InstrumentListAction;
use App\Http\Action\V1\Market\TransactionCreateAction;
use App\Http\Action\V1\Market\TransactionListAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->get('/', Action\HomeAction::class);

    $app->group('/v1', function (RouteCollectorProxy $group): void {

        $group->group('/market', function (RouteCollectorProxy $group): void {

            $group->get('/instrument', InstrumentListAction::class);
            $group->post('/instrument', InstrumentCreateAction::class);

            $group->get('/transaction', TransactionListAction::class);
            $group->post('/transaction', TransactionCreateAction::class);
        });
    });
};
