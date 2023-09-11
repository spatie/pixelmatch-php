<?php

namespace Spatie\Pixelmatch\Tests\Concerns;

use InvalidArgumentException;
use Spatie\Pixelmatch\InvalidThreshold;
use Spatie\Pixelmatch\Pixelmatch;

beforeEach(function () {
    $this->pixelmatch = Pixelmatch::new('path.png', 'path2.png');
});

it('can set include aa as option', function () {
    $this->pixelmatch->includeAa();
    expect($this->pixelmatch->options()['includeAA'])->toBeTrue();

    $this->pixelmatch->includeAa(false);
    expect($this->pixelmatch->options()['includeAA'])->toBeFalse();
});

it('can set the threshold', function () {
    $this->pixelmatch->threshold(0.1);
    expect($this->pixelmatch->options()['threshold'])->toBe(0.1);

    $this->pixelmatch->threshold(1);
    expect($this->pixelmatch->options()['threshold'])->toBe(1.0);

    $this->pixelmatch->threshold(0);
    expect($this->pixelmatch->options()['threshold'])->toBe(0.0);
});

it('cannot set an invalid threshold', function (float $value) {
    $this->pixelmatch->threshold($value);
})->with([
    -0.1,
    1.1,
])->throws(InvalidThreshold::class);

it('only returns the options which are explicitly set', function () {
    expect($this->pixelmatch->options())->toBe([]);

    $this->pixelmatch->includeAA();
    expect($this->pixelmatch->options())->toBe(['includeAA' => true]);

    $this->pixelmatch->threshold(0.9);
    expect($this->pixelmatch->options())->toBe(['includeAA' => true, 'threshold' => 0.9]);
});
