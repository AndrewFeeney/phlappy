<?php

namespace App;

use Laravel\Prompts\Themes\Default\Renderer;

class FlappyRenderer extends Renderer
{
    public function __invoke(Flappy $prompt): string
    {
        $this->line('\_o>_/');

        return $this;
    }
}
