<?php

namespace AndrewFeeney\Phlappy;

use Chewie\Concerns\Aligns;
use Laravel\Prompts\Themes\Default\Renderer as DefaultRenderer;

class Renderer extends DefaultRenderer
{
    use Aligns;

    public function __invoke(Game $prompt): string
    {
        $height = $prompt->terminal()->lines();
        $width = $prompt->terminal()->cols();

        $bird = new Sprite(['__o>__']);
        $grid = new Grid([$bird]);

        $lines = $grid->renderToLines(0, 0, $width - 1, $height - 3);

        foreach ($lines as $line) {
            $this->line($line);
        }

        return $this;
    }
}
