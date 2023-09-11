<?php

use Spatie\Pixelmatch\Exceptions\CouldNotCompare;
use Spatie\Pixelmatch\Exceptions\InvalidImage;
use Spatie\Pixelmatch\Exceptions\InvalidThreshold;
use Spatie\Pixelmatch\Pixelmatch;

it('can get the matching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect((int) $pixelmatch->matchingPercentage())->toBe($result);
})->with([
    'similar images' => [testImage('mapB.png'), testImage('mapB.png'), 100],
    'different images' => [testImage('mapA.png'), testImage('mapB.png'), 96],
]);

it('can get the mismatching pixels between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect($pixelmatch->mismatchingPixels())->toBe($result);
})->with([
    'similar images' => [testImage('textA.png'), testImage('textA.png'), 0],
    'different images' => [testImage('textA.png'), testImage('textB.png'), 106],
]);

it('can get the mismatching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect((int) $pixelmatch->mismatchingPercentage())->toBe($result);
})->with([
    'similar images' => [testImage('mapB.png'), testImage('mapB.png'), 0],
    'different images' => [testImage('mapA.png'), testImage('mapB.png'), 3],
]);

// Options tests
it('can set the threshold higher', function (float $threshold, int $result) {
    $pixelmatch = Pixelmatch::new(testImage('textA.png'), testImage('textB.png'));

    $pixelmatch->threshold($threshold);

    expect($pixelmatch->mismatchingPixels())->toBe($result);
})->with([
    'lowest threshold' => [0, 10279],
    'highest threshold' => [1, 0],
]);

it('throws an exception when the image path is not a .png file', function (string $image1, string $image2) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    $pixelmatch->matchingPercentage();
})->throws(InvalidImage::class)->with([
    'First is .jpg' => [testImage('textB.jpg'), testImage('textA.png')],
    'Second is .jpg' => [testImage('textA.png'), testImage('textB.jpg')],
    'Both are .docx' => [testImage('textB.docx'), testImage('textA.docx')],
]);

it('can set include aa as option', function () {
    $pixelmatch = Pixelmatch::new(testImage('mapB.png'), testImage('mapB.png'));

    $pixelmatch->includeAa();
    expect($pixelmatch->options()['includeAA'])->toBeTrue();

    $pixelmatch->includeAa(false);
    expect($pixelmatch->options()['includeAA'])->toBeFalse();
});

it('can set the threshold', function () {
    $pixelmatch = Pixelmatch::new(testImage('mapB.png'), testImage('mapB.png'));

    $pixelmatch->threshold(0.1);
    expect($pixelmatch->options()['threshold'])->toBe(0.1);

    $pixelmatch->threshold(1);
    expect($pixelmatch->options()['threshold'])->toBe(1.0);

    $pixelmatch->threshold(0);
    expect($pixelmatch->options()['threshold'])->toBe(0.0);
});

it('cannot set an invalid threshold', function (float $value) {
    $pixelmatch = Pixelmatch::new(testImage('mapB.png'), testImage('mapB.png'));

    $pixelmatch->threshold($value);
})->with([
    -0.1,
    1.1,
])->throws(InvalidThreshold::class);

it('cannot compare two images with different dimensions', function() {
   $pixelMatch = Pixelmatch::new(testImage('mapA.png'), testImage('textB.png'));

   $pixelMatch->getResult();
})->throws(CouldNotCompare::class);
