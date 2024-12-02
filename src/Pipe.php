<?php

namespace AndrewFeeney\Phlappy;

class Pipe extends Sprite
{
    public function __construct(private int $height = 0)
    {
        $pipe = [
            '___________',
            '|         |',
            '|_________|',
        ];

        for ($i = 0; $i < $height; $i ++) {
            $pipe[] = ' ||     ||';
        };

        parent::__construct(array_reverse($pipe));
    }
}
