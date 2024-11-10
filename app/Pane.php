<?php

namespace App;

use Illuminate\Support\Collection;

class Pane
{
    private int $width;
    private int $height;
    private Collection $layers;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->layers = collect();
    }

    public function renderRow(int $rowIndex): string
    {
        return $this->row($rowIndex)->render();
    }

    public function addLayer(Layer $layer)
    {
        $this->layers->push($layer);
    }

    private function row(int $rowIndex): Row
    {
        return $this->resolveRows($this->layers->map->row($rowIndex));
    }

    private function resolveRows(Collection $rows)
    {
        return new Row($rows->map(function ($row) {
            return $row->cells()->sortBy('depth')->first() ?? new EmptyCell();
        }));
    }
}
