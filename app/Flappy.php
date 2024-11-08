<?php

namespace App;

use Chewie\Concerns\RegistersRenderers;
use Laravel\Prompts\Prompt;

class Flappy extends Prompt
{
    use RegistersRenderers;

    public function __construct()
    {
        $this->registerRenderer(FlappyRenderer::class);
    }

    public function value(): mixed
    {
        return null;
    }
}
