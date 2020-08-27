<?php

namespace App\Market\RepositoryDoctrine;

use App\Market\Entity\Instrument;
use App\Market\Repository\InstrumentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class InstrumentRepositoryDoctrine implements InstrumentRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
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
}
