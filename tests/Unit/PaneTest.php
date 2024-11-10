<?php

use App\Cell;
use App\Layer;
use App\Pane;
use App\Row;

describe("Pane object", function () {
    it("Can render an empty row", function () {
        $pane = new Pane(1, 1);

        expect($pane->renderRow(0))->toBe('');
    });

    it("Can render an row with a single layer with a single cell", function () {
        $cell = new Cell('*');
        $row = new Row(collect([$cell]));
        $layer = new Layer(collect([$row]));

        $pane = new Pane(1, 1);
        $pane->addLayer($layer);

        expect($pane->renderRow(0))->toBe('*');
    });
});
