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
            if ($row === 0) {
                $this->line("Altitude: {$prompt->bird()->altitude()}    Row: {$birdRow}    Rate Of Climb: {$prompt->bird()->rateOfClimb()}");
            } else if ($row === $prompt->bird()->row()) {
                $leftPadding = str_repeat(' ', floor(($width - 3) / 2));
                $this->line($leftPadding . $prompt->bird()->render());
            } else {
                $this->line($row);
            }
        }

        return $this;
    }
}
