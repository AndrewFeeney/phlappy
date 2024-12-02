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

        $lines = $prompt->grid()->renderToLines(0, 0, $width - 5, -$height + 3);

        foreach ($lines as $index => $line) {
            $this->line($index."  ".$line);
        }

        $this->renderInfo($prompt, $width);

        return $this;
    }

    private function renderInfo(Game $phlappy, $width)
    {
        $altitude = $this->dim(' Altitude: ') . $this->bold($phlappy->bird()->altitude());
        $row = $this->dim(' Row: ') . $this->bold($phlappy->bird()->yOffset());
        $x = $this->dim(' x: ') . $this->bold($phlappy->bird()->xOffset());
        $rateOfClimb = $this->dim(' Rate of Climb: '). $this->bold($phlappy->bird()->rateOfClimb());
        $totalPipes = $this->dim(' Total Pipes: '). $this->bold(count($phlappy->pipes()));
        $latency = $this->dim(' Latency '). $this->bold(round($phlappy->latency() * 1000) .'ms');

        $this->line($this->bgBlue($this->spaceBetween($width, ...[
            $altitude,
            $x,
            $row,
            $rateOfClimb,
            $totalPipes,
            $latency,
        ])));
    }
}
