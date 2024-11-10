<?php

namespace App;

class EmptyCell implements Cell
{
    public function render(): string
    {
        return '';
    }
}
