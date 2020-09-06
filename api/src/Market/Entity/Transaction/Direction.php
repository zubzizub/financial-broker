<?php

namespace App\Market\Entity\Transaction;

use Webmozart\Assert\Assert;

class Direction
{
    public const BUY = 'buy';
    public const SELL = 'sell';

    private string $name;

    public function __construct($name)
    {
        Assert::oneOf($name, [self::BUY, self::SELL]);
        $this->name = $name;
    }

    public function isBuy(): bool
    {
        return $this->name === self::BUY;
    }

    public function isSell(): bool
    {
        return $this->name === self::SELL;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
