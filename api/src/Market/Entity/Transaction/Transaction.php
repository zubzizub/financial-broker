<?php

declare(strict_types=1);

namespace App\Market\Entity\Transaction;

use App\Market\Entity\Instrument;
use DateTimeImmutable;
use Doctrine\ORM\Mapping;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="market_transaction")
 */
class Transaction
{
    /**
     * @Mapping\Id
     * @Mapping\Column(type="guid")
     */
    private string $id;

    /**
     * @Mapping\ManyToOne(targetEntity="App\Market\Entity\Instrument")
     * @Mapping\JoinColumn(name="instrument_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private Instrument $instrument;

    /**
     * @Mapping\Column(type="market_transaction_direction", length=4)
     */
    private Direction $direction;

    /**
     * @Mapping\Column(type="integer")
     */
    private int $status;

    /**
     * @Mapping\Column(type="float")
     */
    private float $price;

    /**
     * @Mapping\Column(type="integer")
     */
    private int $count;

    /**
     * @Mapping\Column(type="text")
     */
    private string $comment;

    /**
     * @Mapping\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    public function __construct(
        Instrument $instrument,
        Direction $direction,
        float $price,
        int $count,
        DateTimeImmutable $createdAt,
        string $comment = ''
    ) {
        Assert::notEmpty($price);
        Assert::notEmpty($count);

        $this->id = Uuid::uuid4()->toString();
        $this->instrument = $instrument;
        $this->direction = $direction;
        $this->price = $price;
        $this->count = $count;
        $this->createdAt = $createdAt;
        $this->comment = $comment;
        $this->status = 1;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Instrument
     */
    public function getInstrument(): Instrument
    {
        return $this->instrument;
    }

    /**
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
