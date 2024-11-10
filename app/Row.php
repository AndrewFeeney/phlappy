<?php

namespace App;

use Illuminate\Support\Collection;

class Row implements Renderable
{
    private Collection $cells;

    public function __construct(?Collection $cells)
    {
        $this->cells = $cells ?? collect();
    }

    public function render(): string
    {
        return $this->cells->map->render()->implode('');
    }
}
