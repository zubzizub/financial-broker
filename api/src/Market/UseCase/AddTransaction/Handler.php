<?php

namespace App\Market\UseCase\AddTransaction;

use App\Components\FlusherInterface;
use App\Market\Entity\Transaction\Direction;
use App\Market\Entity\Transaction\Transaction;
use App\Market\Repository\InstrumentRepositoryInterface;
use App\Market\Repository\TransactionRepositoryInterface;
use DateTimeImmutable;

class Handler
{
    private TransactionRepositoryInterface $transactionRepository;
    private InstrumentRepositoryInterface $instrumentRepository;
    private FlusherInterface $flusher;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        InstrumentRepositoryInterface $instrumentRepository,
        FlusherInterface $flusher
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->instrumentRepository = $instrumentRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command)
    {
        $instrument = $this->instrumentRepository->findById($command->instrumentId);

        $transaction = new Transaction(
            $instrument,
            new Direction($command->direction),
            $command->price,
            $command->count,
            new DateTimeImmutable(),
            $command->comment
        );

        $this->transactionRepository->add($transaction);
        $this->flusher->flush();
    }
}
