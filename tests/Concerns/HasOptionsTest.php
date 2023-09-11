<?php

namespace Spatie\PixelMatch\Tests\Concerns;

use InvalidArgumentException;
use Spatie\PixelMatch\PixelMatch;

beforeEach(function () {
    $this->pixelMatch = PixelMatch::new('path.png', 'path2.png');
});

it('can set include aa as option', function () {
    $this->pixelMatch->includeAa();
    expect($this->pixelMatch->options()['includeAA'])->toBeTrue();

    $this->pixelMatch->includeAa(false);
    expect($this->pixelMatch->options()['includeAA'])->toBeFalse();
});

it('can set the threshold', function () {
    $this->pixelMatch->threshold(0.1);
    expect($this->pixelMatch->options()['threshold'])->toBe(0.1);

    $this->pixelMatch->threshold(1);
    expect($this->pixelMatch->options()['threshold'])->toBe(1.0);

    $this->pixelMatch->threshold(0);
    expect($this->pixelMatch->options()['threshold'])->toBe(0.0);
});

it('cannot set an invalid threshold', function (float $value) {
    $this->pixelMatch->threshold($value);
})->with([
    -0.1,
    1.1,
])->throws(InvalidArgumentException::class);

it('only returns the options which are explicitly set', function () {
    expect($this->pixelMatch->options())->toBe([]);

    $this->pixelMatch->includeAA();
    expect($this->pixelMatch->options())->toBe(['includeAA' => true]);

    $this->pixelMatch->threshold(0.9);
    expect($this->pixelMatch->options())->toBe(['includeAA' => true, 'threshold' => 0.9]);
});
