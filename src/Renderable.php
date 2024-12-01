<?php

namespace AndrewFeeney\Phlappy;

interface Renderable
{
    public function id(): int;

    public function getTileAt(int $x, int $y): Tile;

    public function width(): int;

    public function height(): int;
}

