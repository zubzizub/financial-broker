<?php

namespace App\Market\RepositoryDoctrine;

use App\Market\Entity\Instrument;
use App\Market\Repository\InstrumentRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

class InstrumentRepositoryDoctrine implements InstrumentRepositoryInterface
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Instrument $instrument
     * @throws ORMException
     */
    public function add(Instrument $instrument): void
    {
        $this->entityManager->persist($instrument);
    }

    public function hasByCode(string $code): bool
    {
        // TODO: Implement hasByCode() method.
    }
}
