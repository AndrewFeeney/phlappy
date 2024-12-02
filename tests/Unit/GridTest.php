<?php

use AndrewFeeney\Phlappy\Grid;
use AndrewFeeney\Phlappy\Sprite;

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

    it('can render a single character sprite on a grid', function () {
        $grid = new Grid();
        $sprite = new Sprite();
        $sprite->addTile(x: 0, y: 0, character: 'X');
        $grid->addRenderable($sprite);

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 0, finishY: 0);

        expect($result)->toBe(['X',]);
    });

    it('can render a single character sprite which has been moved to the right on a grid', function () {
        $grid = new Grid();
        $sprite = new Sprite();
        $sprite->addTile(x: 0, y: 0, character: 'X');
        $sprite->move(1, 0);
        $grid->addRenderable($sprite);

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 1, finishY: 0);

        expect($result)->toBe([' X',]);
    });

    it('can render a single character sprite which has been moved down on a grid', function () {
        $grid = new Grid();
        $sprite = new Sprite();
        $sprite->addTile(x: 0, y: 0, character: 'X');
        $sprite->move(0, 1);
        $grid->addRenderable($sprite);

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 0, finishY: 1);

        expect($result)->toBe([' ', 'X']);
    });

    it('can render a 3x2 character sprite on a grid', function () {
        $grid = new Grid();
        $sprite = new Sprite(['ABC', '123']);
        $grid->addRenderable($sprite);

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 2, finishY: 1);

        expect($result)->toBe(['ABC', '123']);
    });

    it('can render a 3x2 character sprite with an offset on a grid', function () {
        $grid = new Grid();
        $sprite = new Sprite(['ABC', '123']);
        $sprite->move(x: 1, y: 1);
        $grid->addRenderable($sprite);

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 3, finishY: 2);

        expect($result)->toBe(['    ', ' ABC', ' 123']);
    });

    it('can render two non-overlapping 1x3 character sprites on a grid', function () {
        $grid = new Grid();
        $topLine = new Sprite(['ABC']);
        $bottomLine = new Sprite(['123']);
        $bottomLine->move(x: 0, y: 1);
        $grid->addRenderable($topLine);
        $grid->addRenderable($bottomLine);

        $result = $grid->renderToLines(startX: 0, startY:0, finishX: 2, finishY: 1);

        expect($result)->toBe(['ABC', '123']);
    });
});
