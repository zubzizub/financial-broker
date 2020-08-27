<?php

namespace App\Market\UseCase\AddInstrument;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=50, allowEmptyString=true)
     */
    public string $code = '';
    /**
     * @Assert\NotBlank()
     */
    public string $title = '';
}
