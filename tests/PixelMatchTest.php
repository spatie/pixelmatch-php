<?php

use Spatie\PixelMatch\PixelMatch;

// Useful start: https://github.com/mapbox/pixelmatch/blob/main/test/test.js

it('can get the matching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelMatch = PixelMatch::new($image1, $image2);

    expect($pixelMatch->matchingPercentage())->toBe($result);
})->with([
    'similar images' => ['tests/fixtures/4b.png', 'tests/fixtures/4b.png', 100],
    'different images' => ['tests/fixtures/4a.png', 'tests/fixtures/4b.png', 96],
]);

it('can get the mismatching pixels between images', function (string $image1, string $image2, int $result) {
    $pixelMatch = PixelMatch::new($image1, $image2);

    expect($pixelMatch->mismatchingPixels())->toBe($result);
})->with([
    'similar images' => ['tests/fixtures/1a.png', 'tests/fixtures/1a.png', 0],
    'different images' => ['tests/fixtures/1a.png', 'tests/fixtures/1b.png', 106],
]);

it('can get the mismatching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelMatch = PixelMatch::new($image1, $image2);

    expect($pixelMatch->mismatchingPercentage())->toBe($result);
})->with([
    'similar images' => ['tests/fixtures/4b.png', 'tests/fixtures/4b.png', 0],
    'different images' => ['tests/fixtures/4a.png', 'tests/fixtures/4b.png', 4],
]);

// Options tests
it('can set the threshold higher', function (float $threshold, int $result) {
    $pixelMatch = PixelMatch::new('tests/fixtures/1a.png', 'tests/fixtures/1b.png');

    $pixelMatch->threshold($threshold);

    expect($pixelMatch->mismatchingPixels())->toBe($result);
})->with([
    'lowest threshold' => [0, 10279],
    'highest threshold' => [1, 0],
]);
