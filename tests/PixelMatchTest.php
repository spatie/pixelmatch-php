<?php

use Spatie\PixelMatch\PixelMatch;

it('can set an option', function () {
    $pixelMatch = PixelMatch::compare('path.png', 'path2.png');

    $pixelMatch->options()->includeAa();

    expect($pixelMatch->options()->includeAA)->toBeTrue();
});
