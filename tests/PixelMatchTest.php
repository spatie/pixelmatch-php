<?php

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
