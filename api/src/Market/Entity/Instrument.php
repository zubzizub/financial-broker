<?php

declare(strict_types=1);

namespace App\Market\Entity;

use Doctrine\ORM\Mapping;
use Exception;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

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
     * @Mapping\Column(type="string", length=50)
     */
    private string $code;

    /**
     * @Mapping\Column(type="string")
     */
    private string $name;

    /**
     * Instrument constructor.
     * @param string $code
     * @param string $name
     * @throws Exception
     */
    public function __construct(string $code, string $name)
    {
        Assert::notEmpty($code);
        Assert::notEmpty($name);

        $this->id = Uuid::uuid4()->toString();
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
