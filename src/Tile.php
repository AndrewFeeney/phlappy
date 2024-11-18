<?php

namespace AndrewFeeney\Phlappy;

class Tile
{
    public function __construct(private string|null $character = null)
    {
    }

    public function render(): string
    {
        return $this->character;
    }
}
