<?php

use AndrewFeeney\Phlappy\Bird;

describe('Bird object', function () {
    it('Initialises position to the center of the window', function () {
        $initialWidthInColumns = 100;
        $initialHeightInRows = 50;

        $bird = new Bird($initialWidthInColumns, $initialHeightInRows);
        expect($bird->xOffset())->toBe(0 - ($initialWidthInColumns / 2) + $bird->width());
        expect($bird->yOffset())->toBe(($initialHeightInRows / 2) - $bird->height());
    });
});
