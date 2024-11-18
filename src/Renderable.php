<?php

namespace AndrewFeeney\Phlappy;

interface Renderable
{
    public function render(): array;
    public function getTileAt(int $x, int $y): Tile;
}

