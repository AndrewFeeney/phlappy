<?php

namespace App;

class Bird
{
    private int $altitude = 10;
    private int $rateOfClimb = 0;

    public function __construct()
    {
    }

    public function render(): string
    {
        $birdState = match (true) {
            $this->rateOfClimb > 5 => '__o>__',
            $this->rateOfClimb > 0 => '/\\o>/\\',
            $this->rateOfClimb <= 0 => '¯\\o>/¯',
        };

        return $birdState;
    }

    public function altitude()
    {
        return $this->altitude;
    }

    public function rateOfClimb(): int
    {
        return $this->rateOfClimb;
    }

    public function flap()
    {
        $this->rateOfClimb = 100;
    }

    public function fall()
    {
        $this->rateOfClimb--;
        $this->altitude = max(0, $this->altitude + $this->rateOfClimb);
    }
}
