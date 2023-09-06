<?php

use Spatie\PixelMatch\PixelMatch;

it('can get the matching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelMatch = PixelMatch::new($image1, $image2);

    expect($pixelMatch->matchingPercentage())->toBe($result);
})->with([
    'similar images' => ['tests/Fixtures/Images/4b.png', 'tests/Fixtures/Images/4b.png', 100],
    'different images' => ['tests/Fixtures/Images/4a.png', 'tests/Fixtures/Images/4b.png', 96],
]);

it('can get the mismatching percentage between images', function (string $image1, string $image2, int $result) {
    $pixelMatch = PixelMatch::new($image1, $image2);

    expect($pixelMatch->mismatchingPercentage())->toBe($result);
})->with([
    'similar images' => ['tests/Fixtures/Images/4b.png', 'tests/Fixtures/Images/4b.png', 0],
    'different images' => ['tests/Fixtures/Images/4a.png', 'tests/Fixtures/Images/4b.png', 4],
]);
