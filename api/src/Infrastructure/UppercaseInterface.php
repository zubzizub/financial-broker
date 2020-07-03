<?php

namespace Api\Infrastructure;

interface UppercaseInterface
{
    public function modify(string $item): string;
}
