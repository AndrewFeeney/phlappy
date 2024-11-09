<?php

namespace App;

class Bird
{
    private int $totalWingPhases = 3;
    private int $altitude = 0;

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

    public function ascend()
    {
        $this->altitude++;
        $this->flap();
    }

    public function descend()
    {
        $this->altitude--;
        $this->flap();
    }

    public function altitude()
    {
        return $this->altitude;
    }

    public function flap()
    {
        $this->wingPhase = ($this->wingPhase + 1) % $this->totalWingPhases;
    }
}
