<?php

namespace App\Services\Juicer\Juicer;

use App\Services\Juicer\Contracts\PartsInterface;

readonly class JuicerService implements PartsInterface
{

    public const MAX_ACTIONS = 100;

    public function __construct(private FruitContainer $container, private Strainer $strainer) {}

    public function container(): FruitContainer
    {
        return $this->container;
    }

    public function strainer(): Strainer
    {
        return $this->strainer;
    }
}
