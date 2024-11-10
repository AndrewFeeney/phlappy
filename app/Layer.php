<?php

namespace App;

use Illuminate\Support\Collection;

class Layer
{
    private Collection $rows;

    public function __construct(?Collection $rows)
    {
        $this->rows = $rows ?? collect();
    }

    public function row(int $rowIndex)
    {
        if ($this->rows->count() < $rowIndex + 1) {
            return new Row(collect());
        }

        return $this->rows[$rowIndex];
    }
}
