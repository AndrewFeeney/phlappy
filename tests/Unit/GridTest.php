<?php

use AndrewFeeney\Phlappy\Grid;

describe('Render method', function () {
    it('can render the given coordinates as an array of strings for an empty 1x1 grid', function () {
        $grid = new Grid();

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 0, finishY: 0);

        expect($result)->toBe([' ']);
    });

    it('can render the given coordinates as an array of strings for an empty 2x2 grid', function () {
        $grid = new Grid();

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 1, finishY: 1);

        expect($result)->toBe(['  ', '  ']);
    });
});
