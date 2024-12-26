<?php

namespace App\Services\Juicer\Juicer;

use App\Services\Juicer\Fruit;

class FruitContainer
{
    public int $capacity = 20;
    public array $fruits = [];


    public function addFruit(Fruit $fruit): void
    {
        $this->capacity -= $fruit->volume;

        if ($this->capacity < 0) {
            throw new \RuntimeException('No space left in container');
        }

        $this->fruits[] = $fruit;
    }

    public function getFruit(): array
    {
        return $this->fruits;
    }

    public function totalVolumeOccupied(): int
    {
        return array_sum(
            array_map(static fn($fruit) => $fruit->volume, $this->fruits)
        );
    }
}
