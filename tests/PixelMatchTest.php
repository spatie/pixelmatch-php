<?php

use Spatie\Pixelmatch\InvalidThreshold;
use Spatie\Pixelmatch\Pixelmatch;

it('can get the matching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect($pixelmatch->matchingPercentage())->toBe($result);
})->with([
    'similar images' => [testImage('4b.png'), testImage('4b.png'), 100],
    'different images' => [testImage('4a.png'), testImage('4b.png'), 96],
]);

it('can get the mismatching pixels between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect($pixelmatch->mismatchingPixels())->toBe($result);
})->with([
    'similar images' => [testImage('1a.png'), testImage('1a.png'), 0],
    'different images' => [testImage('1a.png'), testImage('1b.png'), 106],
]);

it('can get the mismatching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect($pixelmatch->mismatchingPercentage())->toBe($result);
})->with([
    'similar images' => [testImage('4b.png'), testImage('4b.png'), 0],
    'different images' => [testImage('4a.png'), testImage('4b.png'), 4],
]);

// Options tests
it('can set the threshold higher', function (float $threshold, int $result) {
    $pixelmatch = Pixelmatch::new(testImage('1a.png'), testImage('1b.png'));

    $pixelmatch->threshold($threshold);

    expect($pixelmatch->mismatchingPixels())->toBe($result);
})->with([
    'lowest threshold' => [0, 10279],
    'highest threshold' => [1, 0],
]);

it('throws an exception when the image path is not a .png file', function (string $image1, string $image2) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    $pixelmatch->matchingPercentage();
})->throws(InvalidArgumentException::class)->with([
    'First is .jpg' => [testImage('1b.jpg'), testImage('1a.png')],
    'Second is .jpg' => [testImage('1a.png'), testImage('1b.jpg')],
    'Both are .docx' => [testImage('1b.docx'), testImage('1a.docx')],
]);

it('can set include aa as option', function () {
    $pixelmatch = Pixelmatch::new('path.png', 'path2.png');

    $pixelmatch->includeAa();
    expect($pixelmatch->options()['includeAA'])->toBeTrue();

    $pixelmatch->includeAa(false);
    expect($pixelmatch->options()['includeAA'])->toBeFalse();
});

it('can set the threshold', function () {
    $pixelmatch = Pixelmatch::new('path.png', 'path2.png');

    $pixelmatch->threshold(0.1);
    expect($pixelmatch->options()['threshold'])->toBe(0.1);

    $pixelmatch->threshold(1);
    expect($pixelmatch->options()['threshold'])->toBe(1.0);

    $pixelmatch->threshold(0);
    expect($pixelmatch->options()['threshold'])->toBe(0.0);
});

it('cannot set an invalid threshold', function (float $value) {
    $pixelmatch = Pixelmatch::new('path.png', 'path2.png');

    $pixelmatch->threshold($value);
})->with([
    -0.1,
    1.1,
])->throws(InvalidThreshold::class);

it('only returns the options which are explicitly set', function () {
    $pixelmatch = Pixelmatch::new('path.png', 'path2.png');

    expect($pixelmatch->options())->toBe([]);

    $pixelmatch->includeAA();
    expect($pixelmatch->options())->toBe(['includeAA' => true]);

    $pixelmatch->threshold(0.9);
    expect($pixelmatch->options())->toBe(['includeAA' => true, 'threshold' => 0.9]);
});
