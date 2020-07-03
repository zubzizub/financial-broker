<?php

namespace Api\Http\Action;

use Api\Http\JsonResponse;
use Api\Infrastructure\UppercaseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeAction implements \Psr\Http\Server\RequestHandlerInterface
{
    private $upper;

    public function __construct(UppercaseInterface $upper)
    {
        $this->upper = $upper;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            'name' => $this->upper->modify('App API'),
            'version' => '1.0',
        ]);
    }
}
