<?php

namespace AndrewFeeney\Phlappy;

class Grid
{
    public function __construct(private array $sprites = [])
    {
    }

    public function renderToLines(int $startX, int $startY, int $finishX, int $finishY): array
    {
        $lines = [];

        foreach (range($startY, $finishY) as $lineIndex) {
            $line = '';
            foreach (range($startX, $finishX) as $columnIndex) {
                $character = ' ';
                foreach ($this->sprites as $sprite) {
                    $tile = $sprite->getTileAt($columnIndex, $lineIndex);
                    if ($tile->isEmpty()) {
                        continue;
                    }
                    $character = $tile->render();
                }
                $line .= $character ?? ' ';
            }
            $lines[] = $line;
        }

        return $lines;
    }

    public function addSprite(Sprite $sprite)
    {
        $this->sprites[] = $sprite;
    }
}
