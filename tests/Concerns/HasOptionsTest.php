<?php

namespace Spatie\Pixelmatch\Tests\Concerns;

use InvalidArgumentException;
use Spatie\Pixelmatch\InvalidThreshold;
use Spatie\Pixelmatch\Pixelmatch;

beforeEach(function () {
    $this->Pixelmatch = Pixelmatch::new('path.png', 'path2.png');
});

it('can set include aa as option', function () {
    $this->Pixelmatch->includeAa();
    expect($this->Pixelmatch->options()['includeAA'])->toBeTrue();

    $this->Pixelmatch->includeAa(false);
    expect($this->Pixelmatch->options()['includeAA'])->toBeFalse();
});

it('can set the threshold', function () {
    $this->Pixelmatch->threshold(0.1);
    expect($this->Pixelmatch->options()['threshold'])->toBe(0.1);

    $this->Pixelmatch->threshold(1);
    expect($this->Pixelmatch->options()['threshold'])->toBe(1.0);

    $this->Pixelmatch->threshold(0);
    expect($this->Pixelmatch->options()['threshold'])->toBe(0.0);
});

it('cannot set an invalid threshold', function (float $value) {
    $this->Pixelmatch->threshold($value);
})->with([
    -0.1,
    1.1,
])->throws(InvalidThreshold::class);

it('only returns the options which are explicitly set', function () {
    expect($this->Pixelmatch->options())->toBe([]);

    $this->Pixelmatch->includeAA();
    expect($this->Pixelmatch->options())->toBe(['includeAA' => true]);

    $this->Pixelmatch->threshold(0.9);
    expect($this->Pixelmatch->options())->toBe(['includeAA' => true, 'threshold' => 0.9]);
});
