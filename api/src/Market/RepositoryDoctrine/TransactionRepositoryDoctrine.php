<?php

namespace App\Market\RepositoryDoctrine;

use App\Market\Entity\Transaction\Transaction;
use App\Market\Repository\TransactionRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class TransactionRepositoryDoctrine implements TransactionRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, EntityRepository $repository)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function add(Transaction $transaction): void
    {
        $this->entityManager->persist($transaction);
    }

    /**
     * @return Transaction[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
