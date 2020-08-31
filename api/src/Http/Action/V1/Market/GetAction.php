<?php

namespace App\Http\Action\V1\Market;

use App\Http\JsonResponse;
use App\Market\Entity\Instrument;
use App\Market\Repository\InstrumentRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetAction implements RequestHandlerInterface
{
    private InstrumentRepositoryInterface $repository;

    public function __construct(InstrumentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $instruments = $this->repository->findAll();

        return new JsonResponse([
            'count' => count($instruments),
            'data' => array_map([$this, 'serialize'], $instruments),
        ]);
    }

    private function serialize(Instrument $instrument): array
    {
        return [
            'id' => $instrument->getId(),
            'code' => $instrument->getCode(),
            'name' => $instrument->getName(),
        ];
    }
}
