<?php

namespace App;

class Bird
{
    private int $totalWingPhases = 3;

    public function __construct(private int $wingPhase = 1)
    {
    }

    public function render(): string
    {
        $birdState = match ($this->wingPhase) {
            0 => '__o>__',
            1 => '/\\o>/\\',
            2 => '¯\\o>/¯',
        };

        return $birdState;
    }

    public function wingPhase(): int
    {
        return $this->wingPhase;
    }

    public function flap()
    {
        $this->wingPhase = ($this->wingPhase + 1) % $this->totalWingPhases;
    }
}
