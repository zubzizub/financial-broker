<?php

namespace App\Infrastructure;

interface UppercaseInterface
{
    public function modify(string $item): string;
}
