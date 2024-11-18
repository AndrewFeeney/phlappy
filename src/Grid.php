<?php

namespace AndrewFeeney\Phlappy;

class Grid
{
    public function renderToLines(int $startX, int $startY, int $finishX, int $finishY): array
    {
        $lines = [];

        foreach (range($startY, $finishY) as $lineIndex) {
            $line = '';
            foreach (range($startX, $finishX) as $columnIndex) {
                $line .= ' ';
            }
            $lines[] = $line;
        }

        return $lines;
    }
}
