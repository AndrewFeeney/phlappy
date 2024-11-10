<?php

use App\Pane;

describe("Pane object", function () {
    it("Can render an empty row", function () {
        $pane = new Pane(1, 1);

        expect($pane->renderRow(0))->toBe('');
    });
});
