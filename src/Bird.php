<?php

namespace AndrewFeeney\Phlappy;

class Bird implements Renderable
{
    const LINE_HEIGHT = 1000;

    private array $lines = [];

    private int $xOffset = 0;

    private int $yOffset = 0;

    private int $rateOfClimb = 0;

    private int $altitude = 0;

    private int $groundLevel;

    public function __construct($initialWidth, $initialHeight)
    {
        $this->groundLevel = $initialHeight - 3;
        $this->xOffset = floor(($initialWidth / 2) - 5);
        $this->altitude = floor($this->groundLevel / 2) * self::LINE_HEIGHT;
        $this->yOffset = $this->calculateYOffset();

        $initialLines = ['__0>__'];

        foreach ($initialLines as $line) {
            $newLine = [];

            foreach (str_split($line) as $character) {
                $newLine[] = new Tile($character);
            }

            $this->lines[] = $newLine;
        }
    }

    public function move(int $x, int $y): void
    {
        $this->xOffset -= $x;
        $this->yOffset -= $y;
    }

    public function fall()
    {
        $this->altitude = max(0, $this->altitude + $this->rateOfClimb);
        $this->yOffset = $this->calculateYOffset();
        $this->rateOfClimb = $this->rateOfClimb - 1;
    }

    public function flap()
    {
        $this->rateOfClimb = (int) floor(self::LINE_HEIGHT / 8);
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


    public function yOffset(int $y = 0)
    {
        return $this->yOffset + $y;
    }

    public function xOffset(int $x = 0)
    {
        return $x - $this->xOffset;
    }

    public function rateOfClimb()
    {
        return $this->rateOfClimb;
    }

    public function altitude()
    {
        return $this->altitude;
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

    private function lineExists(int $y): bool
    {
        return array_key_exists($this->yOffset($y), $this->lines);
    }

    private function calculateYOffset()
    {
        $altitudeInLines = (int) floor($this->altitude / self::LINE_HEIGHT);

        return min($this->groundLevel, $this->groundLevel - $altitudeInLines);
    }
}
