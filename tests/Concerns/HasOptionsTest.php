<?php

namespace Spatie\PixelMatch\Tests\Concerns;

use InvalidArgumentException;
use Spatie\PixelMatch\PixelMatch;

beforeEach(function () {
    $this->pixelMatch = PixelMatch::new('path.png', 'path2.png');
});

it('can set include aa as option', function () {
    expect($this->pixelMatch->includeAA)->toBeFalse();

    $this->pixelMatch->includeAa();

    expect($this->pixelMatch->includeAA)->toBeTrue();
});

it('can set the threshold', function () {
    $this->pixelMatch->threshold(0.1);
    expect($this->pixelMatch->threshold)->toBe(0.1);

    $this->pixelMatch->threshold(1);
    expect($this->pixelMatch->threshold)->toBe(1);

    $this->pixelMatch->threshold(0);
    expect($this->pixelMatch->threshold)->toBe(0);
});

it('cannot set an invalid threshold', function (float $value) {
    $this->expectException(InvalidArgumentException::class);

    $this->pixelMatch->threshold($value);
})->with([
    -0.1,
    1.1,
]);

it('only returns the options which are explicitly set', function () {
    expect($this->pixelMatch->options())->toBe([]);

    $this->pixelMatch->includeAA();
    expect($this->pixelMatch->options())->toBe(['includeAA' => true]);

    $this->pixelMatch->threshold(0.9);
    expect($this->pixelMatch->options())->toBe(['includeAA' => true, 'threshold' => 0.9]);
});
