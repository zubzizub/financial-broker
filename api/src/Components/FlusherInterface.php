<?php

declare(strict_types=1);

namespace App\Components;

interface FlusherInterface
{
    public function flush(): void;
}
