<?php

namespace AndrewFeeney\Phlappy;

class Tile
{
    public function __construct(private string|null $character = null)
    {
    }

    public function render(): string|null
    {
        return $this->character;
    }
}
