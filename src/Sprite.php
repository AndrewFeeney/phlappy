<?php

namespace AndrewFeeney\Phlappy;

class Sprite implements Renderable
{
    private array $lines = [];

    private int $xOffset = 0;

    private int $yOffset = 0;

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

    public function addTile(int $x, int $y, string $character): void
    {
        if (!$this->lineExists($y)) {
            $this->addLine($y);
        }

        $this->lines[$y][$x] = new Tile(character: $character);
    }

    public function move(int $x, int $y): void
    {
        $this->xOffset -= $x;
        $this->yOffset -= $y;
    }

    public function getTileAt(int $x, int $y): Tile
    {
        if (!$this->lineExists($y)) {
            return $this->getEmptyTile();
        }

        $line = $this->getLine($y);

        if (!array_key_exists($this->xOffset($x), $line)) {
            return $this->getEmptyTile();
        }

        return $line[$this->xOffset($x)];
    }


    private function yOffset(int $y = 0)
    {
        return $this->yOffset + $y;
    }

    private function xOffset(int $x = 0)
    {
        return $this->xOffset + $x;
    }

    private function getLine(int $y): array
    {
        return $this->lines[$this->yOffset($y)];
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
        return array_key_exists($this->yOffset($y), $this->lines);
    }
}
