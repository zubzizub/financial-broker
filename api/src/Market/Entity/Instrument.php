<?php

declare(strict_types=1);

namespace App\Market\Entity;

use Doctrine\ORM\Mapping;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="market_instrument")
 */
class Instrument
{
    /**
     * @Mapping\Id
     * @Mapping\Column(type="guid")
     */
    private string $id;

    /**
     * @Mapping\Column(type="string", nullable=true)
     */
    private string $code;

    private function __construct(string $id, string $code)
    {
        $this->id = $id;
        $this->code = $code;
    }
}
