<?php

namespace Spatie\PixelMatch\Tests\Concerns;

use Spatie\PixelMatch\PixelMatch;

beforeEach(function () {
    $this->pixelMatch = PixelMatch::new('path.png', 'path2.png');
});

it('can set include aa as option', function () {
    $this->pixelMatch->includeAa();

    expect($this->pixelMatch->includeAA)->toBeTrue();
});

it('only returns the options which are explicitly set', function () {
    expect($this->pixelMatch->options())->toBe([]);

    $this->pixelMatch->includeAA();
    expect($this->pixelMatch->options())->toBe(['includeAA' => true]);

    $this->pixelMatch->threshold(1.2);
    expect($this->pixelMatch->options())->toBe(['includeAA' => true, 'threshold' => 1.2]);
});
