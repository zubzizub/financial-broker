<?php

namespace App\Market\RepositoryDoctrine\Types;

use App\Market\Entity\Transaction\Direction;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class DirectionType extends StringType
{
    public const NAME = 'market_transaction_direction';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Direction ? $value->getName() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Direction((string)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
