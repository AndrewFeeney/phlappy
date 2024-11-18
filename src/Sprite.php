<?php

namespace AndrewFeeney\Phlappy;

class Sprite
{
    public function __construct(private array $lines = [])
    {
    }

    public function render(): array
    {
        $output = [];

        foreach ($this->lines as $line) {
            $output[] = $this->renderLine($line);
        }

        return $output;
    }

    public function addTile(int $x, int $y, string $character): void
    {
        if (!array_key_exists($y, $this->lines)) {
            $this->lines[$y] = [];
        }

        $this->lines[$y][$x] = new Tile(character: $character);
    }

    private function renderLine(array $tiles): string
    {
        $line = '';

        foreach ($tiles as $tile) {
            $line .= $tile->render();
        }

        return $line;
    }
}

