<?php

namespace App;

use Laravel\Prompts\Themes\Default\Renderer as DefaultRenderer;

class Renderer extends DefaultRenderer
{
    public function __invoke(Phlappy $prompt): string
    {
        $height = $prompt->terminal()->lines();
        $width = $prompt->terminal()->cols();

        foreach (range($height - 2, 0) as $row) {
            if ($row === $prompt->bird()->altitude()) {
                $leftPadding = str_repeat(' ', floor(($width - 3) / 2));
                $this->line($leftPadding . $prompt->bird()->render());
            } else {
                $this->line(' ');
            }
        }

        return $this;
    }
}
