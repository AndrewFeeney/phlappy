<?php

namespace App;

use Laravel\Prompts\Themes\Default\Renderer as DefaultRenderer;

class Renderer extends DefaultRenderer
{
    public function __invoke(Phlappy $prompt): string
    {
        $height = $prompt->terminal()->lines();

        foreach (range($height - 2, 0) as $row) {
            $this->line($row === $prompt->bird()->altitude() ? $prompt->bird()->render() : ' ');
        }

        return $this;
    }
}
