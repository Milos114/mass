<?php

namespace App\Services\Juicer;

abstract class Fruit
{
    public function __construct(string $color)
    {
    }

    abstract public function volume(): int;
}
