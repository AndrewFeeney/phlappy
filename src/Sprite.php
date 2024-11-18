<?php

namespace AndrewFeeney\Phlappy;

class Sprite
{
    private array $lines = [];

    public function __construct(array $initialLines = [])
    {
        foreach ($initialLines as $line) {
            $newLine = [];

            foreach (str_split($line) as $character) {
                $newLine[] = new Tile($character);
            }

            $this->lines[] = $newLine;
        }
    }

    public function render(): array
    {
        $output = [];

        foreach ($this->lines as $line) {
            $output[] = $this->renderLine($line);
        }

        return $output;
    }

    public function renderTileAt(int $x, int $y): string
    {
        $tile = $this->getTileAt(x: $x, y: $y);

        return $tile->render() ?? ' ';
    }

    public function addTile(int $x, int $y, string $character): void
    {
        if (!$this->lineExists($y)) {
            $this->addLine($y);
        }

        $this->lines[$y][$x] = new Tile(character: $character);
    }

    private function getTileAt(int $x, int $y): Tile
    {
        if (!$this->lineExists($y)) {
            return $this->getEmptyTile();
        }

        if (!array_key_exists($x, $this->lines[$y])) {
            return $this->getEmptyTile();
        }

        return $this->lines[$y][$x];
    }

    private function renderLine(array $tiles): string
    {
        $line = '';

        foreach ($tiles as $tile) {
            $line .= $tile->render();
        }

        return $line;
    }

    private function getEmptyTile(): Tile
    {
        return new Tile();
    }

    private function addLine(int $y): void
    {
        $this->lines[$y] = [];
    }

    private function lineExists(int $y): bool
    {
        return array_key_exists($y, $this->lines);
    }
}

