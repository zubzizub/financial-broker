<?php

namespace App\Market\UseCase\AddTransaction;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Uuid()
     */
    public string $instrumentId;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    public string $direction;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("float")
     */
    public float $price;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    public int $count;

    public string $comment = '';
}
