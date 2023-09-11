<?php

use Spatie\Pixelmatch\Pixelmatch;

it('can get the matching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect($pixelmatch->matchingPercentage())->toBe($result);
})->with([
    'similar images' => ['tests/fixtures/4b.png', 'tests/fixtures/4b.png', 100],
    'different images' => ['tests/fixtures/4a.png', 'tests/fixtures/4b.png', 96],
]);

it('can get the mismatching pixels between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect($pixelmatch->mismatchingPixels())->toBe($result);
})->with([
    'similar images' => ['tests/fixtures/1a.png', 'tests/fixtures/1a.png', 0],
    'different images' => ['tests/fixtures/1a.png', 'tests/fixtures/1b.png', 106],
]);

it('can get the mismatching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    expect($pixelmatch->mismatchingPercentage())->toBe($result);
})->with([
    'similar images' => ['tests/fixtures/4b.png', 'tests/fixtures/4b.png', 0],
    'different images' => ['tests/fixtures/4a.png', 'tests/fixtures/4b.png', 4],
]);

// Options tests
it('can set the threshold higher', function (float $threshold, int $result) {
    $pixelmatch = Pixelmatch::new('tests/fixtures/1a.png', 'tests/fixtures/1b.png');

    $pixelmatch->threshold($threshold);

    expect($pixelmatch->mismatchingPixels())->toBe($result);
})->with([
    'lowest threshold' => [0, 10279],
    'highest threshold' => [1, 0],
]);

// Exceptions
it('throws an exception when the image path is not a .png file', function (string $image1, string $image2) {
    $pixelmatch = Pixelmatch::new($image1, $image2);

    $pixelmatch->matchingPercentage();
})->throws(InvalidArgumentException::class)->with([
    'First is .jpg' => ['tests/fixtures/1b.jpg', 'tests/fixtures/1a.png'],
    'Second is .jpg' => ['tests/fixtures/1a.png', 'tests/fixtures/1b.jpg'],
    'Both are .docx' => ['tests/fixtures/1b.docx', 'tests/fixtures/1a.docx'],
]);
