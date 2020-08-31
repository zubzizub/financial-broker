<?php

namespace App\Market\Repository;

use App\Market\Entity\Instrument;

interface InstrumentRepositoryInterface
{
    public function add(Instrument $instrument): void;

    public function hasByCode(string $code): bool;

    public function findAll(): array;
}
