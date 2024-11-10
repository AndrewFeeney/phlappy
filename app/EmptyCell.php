<?php

namespace App;

class EmptyCell implements Renderable
{
    public function render(): string
    {
        return '';
    }
}
