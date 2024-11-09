<?php

namespace App;

use Laravel\Prompts\Themes\Default\Renderer as DefaultRenderer;

class Renderer extends DefaultRenderer
{
    public function __invoke(Phlappy $prompt): string
    {
        $this->line($prompt->bird()->render());

        return $this;
    }
}
