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
                $this->renderInfo($prompt, $width);
            } else if ($row === $prompt->bird()->row()) {
                $this->centerHorizontally($prompt->bird()->render(), $width)
                    ->each($this->line(...));
            } else {
                $this->line(' ');
            }
        }

        return $this;
    }

    private function renderInfo(Phlappy $phlappy, $width)
    {
        $altitude = $this->dim(' Altitude: ') . $this->bold($phlappy->bird()->altitude());
        $row = $this->dim(' Row: ') . $this->bold($phlappy->bird()->row());
        $rateOfClimb = $this->dim(' Rate of Climb: '). $this->bold($phlappy->bird()->rateOfClimb());

        $this->line($this->bgBlue($this->spaceBetween($width, ...[
            $altitude,
            $row,
            $rateOfClimb,
        ])));
    }
}
