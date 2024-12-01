<?php

namespace AndrewFeeney\Phlappy;

class Bird implements Renderable
{
    const LINE_HEIGHT = 1000;

    private array $tilesFlatWings = [];
    private array $tilesFoldedWings = [];
    private array $tilesRaisedWings = [];

    private int $xOffset = 0;

    private int $yOffset = 0;

    private int $rateOfClimb;

    private int $altitude = 0;

    private int $groundLevel;

    public function __construct($initialWidth, $initialHeight, $initialRateOfClimb = 0)
    {
        $this->rateOfClimb = $initialRateOfClimb;
        $this->groundLevel = $initialHeight - 3;
        $this->xOffset = floor(($initialWidth / 2) - $this->width());
        $this->altitude = floor($this->groundLevel / 2) * self::LINE_HEIGHT;
        $this->yOffset = $this->calculateYOffset();

        $this->tilesFlatWings = $this->loadTilesFromString('__o>__');
        $this->tilesFoldedWings = $this->loadTilesFromString('/\\o>/\\');
        $this->tilesRaisedWings = $this->loadTilesFromString('¯\\o>/¯');
    }

    public function id(): int
    {
        return random_int(0, PHP_INT_MAX);
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

    public function height(): int
    {
        return 1;
    }

    public function width(): int
    {
        return 6;
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
        return $this->getTiles()[$this->yOffset($y)];
    }

    private function getEmptyTile(): Tile
    {
        return new Tile();
    }

    private function lineExists(int $y): bool
    {
        return array_key_exists($this->yOffset($y), $this->getTiles());
    }

    private function calculateYOffset()
    {
        $altitudeInLines = (int) floor($this->altitude / self::LINE_HEIGHT);

        return min($this->groundLevel, $this->groundLevel - $altitudeInLines);
    }

    private function loadTilesFromString(string $input): array
    {
        $tiles = [];

        foreach (mb_str_split($input) as $character) {
            $tiles[] = new Tile($character);
        }

        return $tiles;
    }

    private function getTiles()
    {
        $tiles = match (true) {
            $this->rateOfClimb <= 0 => $this->tilesRaisedWings,
            $this->rateOfClimb <= 5 => $this->tilesFoldedWings,
            default => $this->tilesFlatWings,
        };

        return [$tiles];
    }
}
