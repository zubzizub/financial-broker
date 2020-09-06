<?php

namespace App\Http\Action\V1\Market;

use App\Http\JsonResponse;
use App\Market\Entity\Transaction\Transaction;
use App\Market\Repository\TransactionRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TransactionListAction implements RequestHandlerInterface
{
    private TransactionRepositoryInterface $repository;

    public function __construct(TransactionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $transactions = $this->repository->findAll();

        return new JsonResponse([
            'count' => count($transactions),
            'data' => array_map([$this, 'serialize'], $transactions),
        ]);
    }

    private function serialize(Transaction $transaction): array
    {
        return [
            'id' => $transaction->getId(),
            'direction' => $transaction->getDirection()->getName(),
            'instrumentId' => $transaction->getInstrument()->getId(),
            'price' => $transaction->getPrice(),
            'count' => $transaction->getCount()
        ];
    }
}
