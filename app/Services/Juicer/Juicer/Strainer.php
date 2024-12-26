<?php

namespace App\Services\Juicer\Juicer;

class Strainer
{

    public float $squeezeEfficiency = 0.5;

    public function squeeze(array $apples): float
    {
        return array_sum(
            array_map(static fn($apple) => $apple->volume, $apples)
        ) * $this->squeezeEfficiency;
    }
}
