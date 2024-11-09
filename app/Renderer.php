<?php

namespace App;

use Chewie\Concerns\Aligns;
use Laravel\Prompts\Themes\Default\Renderer as DefaultRenderer;

class Renderer extends DefaultRenderer
{
    use Aligns;

    public function __invoke(Phlappy $prompt): string
    {
        $height = $prompt->terminal()->lines();
        $width = $prompt->terminal()->cols();

        foreach (range($height - 2, 0) as $row) {
            if ($row === 0) {
                $this->renderInfo($prompt);
            } else if ($row === $prompt->bird()->row()) {
                $this->centerHorizontally($prompt->bird()->render(), $width)
                    ->each($this->line(...));
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
