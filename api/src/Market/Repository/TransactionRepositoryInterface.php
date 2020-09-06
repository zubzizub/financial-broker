<?php

namespace App\Market\Repository;

use App\Market\Entity\Transaction\Transaction;

interface TransactionRepositoryInterface
{
    public function add(Transaction $transaction): void;

    public function findAll(): array;
}
