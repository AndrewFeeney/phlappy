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

    it('Has flat wings when rising faster than 5 units per tick', function () {
        $initialWidthInColumns = 12;
        $initialHeightInRows = 3;

        $bird = new Bird($initialWidthInColumns, $initialHeightInRows, 6);

        expect($bird->getTileAt(0, 0)->render())->toBe('_');
        expect($bird->getTileAt(1, 0)->render())->toBe('_');
        expect($bird->getTileAt(2, 0)->render())->toBe('o');
        expect($bird->getTileAt(3, 0)->render())->toBe('>');
        expect($bird->getTileAt(4, 0)->render())->toBe('_');
        expect($bird->getTileAt(5, 0)->render())->toBe('_');
    });

    it('Has raised wings when falling', function () {
        $initialWidthInColumns = 6;
        $initialHeightInRows = 1;

        $bird = new Bird($initialWidthInColumns, $initialHeightInRows);
        $bird->fall();

        expect($bird->getTileAt(-3, -$bird->yOffset())->render())->toBe('¯');
        expect($bird->getTileAt(-2, -$bird->yOffset())->render())->toBe('\\');
        expect($bird->getTileAt(-1, -$bird->yOffset())->render())->toBe('o');
        expect($bird->getTileAt(0, -$bird->yOffset())->render())->toBe('>');
        expect($bird->getTileAt(1, -$bird->yOffset())->render())->toBe('/');
        expect($bird->getTileAt(2, -$bird->yOffset())->render())->toBe('¯');
    });

    it('Has folded wings when rising at 2 units per tick', function () {
        $initialWidthInColumns = 6;
        $initialHeightInRows = 1;

        $bird = new Bird($initialWidthInColumns, $initialHeightInRows, 2);

        expect($bird->getTileAt(-3, -$bird->yOffset())->render())->toBe('/');
        expect($bird->getTileAt(-2, -$bird->yOffset())->render())->toBe('\\');
        expect($bird->getTileAt(-1, -$bird->yOffset())->render())->toBe('o');
        expect($bird->getTileAt(0, -$bird->yOffset())->render())->toBe('>');
        expect($bird->getTileAt(1, -$bird->yOffset())->render())->toBe('/');
        expect($bird->getTileAt(2, -$bird->yOffset())->render())->toBe('\\');
    });
});
