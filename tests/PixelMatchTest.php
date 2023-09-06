<?php

use Spatie\PixelMatch\PixelMatch;

it('can set an option', function () {
    $pixelMatch = PixelMatch::new('path.png', 'path2.png');

    $pixelMatch->options()->includeAa();

    expect($pixelMatch->options()->includeAA)->toBeTrue();
});

it('can can execute node', function () {
    $pixelMatch = PixelMatch::new('../tests/Fixtures/Images/4b.png', '../tests/Fixtures/Images/4b.png');

    expect($pixelMatch->compare())->toBe("100");
});
