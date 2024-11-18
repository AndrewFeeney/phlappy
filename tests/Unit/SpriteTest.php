<?php

use AndrewFeeney\Phlappy\Sprite;

describe('Render method', function () {
    it('can render a single character sprite to an array of lines', function () {
        $sprite = new Sprite();
        $sprite->addTile(x: 0, y: 0, character: 'X');

        $result = $sprite->render();

        expect($result)->toBe(['X']);
    });

    it('can render a three character sprite to an array of lines', function () {
        $sprite = new Sprite();
        $sprite->addTile(x: 0, y: 0, character: '0');
        $sprite->addTile(x: 1, y: 0, character: '_');
        $sprite->addTile(x: 2, y: 0, character: '0');

        $result = $sprite->render();

        expect($result)->toBe(['0_0']);
    });

    it('can render a three x three sprite to an array of lines', function () {
        $sprite = new Sprite();
        $sprite->addTile(x: 0, y: 0, character: '0');
        $sprite->addTile(x: 1, y: 0, character: '_');
        $sprite->addTile(x: 2, y: 0, character: '0');
        $sprite->addTile(x: 0, y: 1, character: '\\');
        $sprite->addTile(x: 1, y: 1, character: '_');
        $sprite->addTile(x: 2, y: 1, character: '/');

        $result = $sprite->render();

        expect($result)->toBe([
            '0_0',
            '\\_/',
        ]);
    });
});

describe('renderTileAt method', function () {
    it('can render the tile at a given set of coordinates', function () {
        $sprite = new Sprite();
        $sprite->addTile(x: 0, y: 0, character: '0');
        $sprite->addTile(x: 1, y: 0, character: '_');
        $sprite->addTile(x: 2, y: 0, character: '0');
        $sprite->addTile(x: 0, y: 1, character: '\\');
        $sprite->addTile(x: 1, y: 1, character: '_');
        $sprite->addTile(x: 2, y: 1, character: '/');

        $result = $sprite->renderTileAt(x: 0, y: 0);

        expect($result)->toBe('0');
    });

    it('renders an empty space if nothing is at the given set of coordinates', function () {
        $sprite = new Sprite();

        $result = $sprite->renderTileAt(x: 0, y: 0);

        expect($result)->toBe(' ');
    });
});
