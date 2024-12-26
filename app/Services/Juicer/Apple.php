<?php

namespace App\Services\Juicer;

use Random\RandomException;

class Apple extends Fruit
{
    public int $volume;
    public int $isRotten    ;

    /**
     * @throws RandomException
     */
    public function __construct(string $color)
    {
        parent::__construct($color);
        $this->volume = $this->volume();
        $this->isRotten = $this->isRotten();
    }

    /**
     * @throws RandomException
     */
    public function volume(): int
    {
        return random_int(1, 5);
    }

    /**
     * @throws RandomException
     */
    public function isRotten(): bool
    {
        return random_int(1, 100) <= 20;
    }

    public static function totalVolume($fruits): int
    {
        $totalVolume = 0;
        foreach ($fruits as $fruit) {
            $totalVolume += $fruit->volume;
        }
        return $totalVolume;
    }
}
