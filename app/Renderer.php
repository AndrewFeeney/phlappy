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
                $this->renderInfo($prompt);
            } else if ($row === $prompt->bird()->row()) {
                $leftPadding = str_repeat(' ', floor(($width - 3) / 2));
                $this->line($leftPadding . $this->bold($prompt->bird()->render()));
            } else {
                $this->line(' ');
            }
        }

        return $this;
    }

    private function renderInfo(Phlappy $phlappy)
    {
        $altitude = str_pad($phlappy->bird()->altitude(), 10);
        $row = str_pad($phlappy->bird()->row(), 10);
        $rateOfClimb = str_pad($phlappy->bird()->rateOfClimb(), 10);

        $this->line($this->bgBlue($this->bold(implode('  ', [
            "Altitude: {$altitude}",
            "Row: {$row}",
            "Rate Of Climb: {$rateOfClimb}",
        ]))));
    }
}
