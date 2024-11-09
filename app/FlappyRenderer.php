<?php

namespace App;

use Laravel\Prompts\Themes\Default\Renderer;

class FlappyRenderer extends Renderer
{
    public function __invoke(Flappy $prompt): string
    {
        $this->line($prompt->bird()->render());

        return $this;
    }
}
