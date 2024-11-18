<?php

namespace AndrewFeeney\Phlappy;

interface Renderable
{
    public function getTileAt(int $x, int $y): Tile;
}

