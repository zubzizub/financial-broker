<?php

declare(strict_types=1);

namespace App\Components;

interface Flusher
{
    public function flush(): void;
}
