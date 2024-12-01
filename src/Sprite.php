<?php

namespace AndrewFeeney\Phlappy;

class Sprite implements Renderable
{
    private array $lines = [];

    private int $xOffset;

    private int $yOffset;

    public function __construct(array $initialLines = [], int $initialXOffset = 0, int $initialYOffset = 0)
    {
        foreach (array_reverse($initialLines) as $line) {
            $newLine = [];

            foreach (str_split($line) as $character) {
                $newLine[] = new Tile($character);
            }

            $this->lines[] = $newLine;
        }

        $this->xOffset = $initialXOffset;
        $this->yOffset = $initialYOffset;
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

    public function width(): int
    {
        return collect($this->lines)->reduce(fn ($max, $line) => max($max, count($line)), 0);
    }

    public function height(): int
    {
        return count($this->lines);
    }

    public function yOffset(int $y = 0)
    {
        return $this->yOffset + $y;
    }

    public function xOffset(int $x = 0)
    {
        return $this->xOffset + $x;
    }

    public function id(): int
    {
        return random_int(0, PHP_INT_MAX);
    }

    private function getLine(int $y): array
    {
        return $this->lines[$this->yOffset($y)];
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
