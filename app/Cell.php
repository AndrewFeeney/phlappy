<?php

namespace App;

class Cell implements Renderable
{
    public function __construct(private string $character = ' ')
    {
    }

    public function render(): string
    {
        return $this->character;
    }
}
