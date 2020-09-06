<?php

namespace App\Market\RepositoryDoctrine;

use App\Market\Entity\Instrument;
use App\Market\Repository\InstrumentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

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

    public function findById(string $id): Instrument
    {
        /** @var Instrument $instrument */
        $instrument = $this->repository->find($id);

        if ($instrument === null) {
            throw new DomainException('Instrument not found');
        }
        return $instrument;
    }

    /**
     * @return Instrument[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
