<?php

namespace App\Market\RepositoryDoctrine;

use App\Market\Entity\Instrument;
use App\Market\Repository\InstrumentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class InstrumentRepositoryDoctrine implements InstrumentRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, EntityRepository $repository)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function add(Instrument $instrument): void
    {
        $this->entityManager->persist($instrument);
    }

    public function hasByCode(string $code): bool
    {
        return true;
    }

    /**
     * @return Instrument[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
