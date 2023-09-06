<?php

namespace Spatie\PixelMatch\Tests\Actions;

use Spatie\PixelMatch\Actions\ExecuteNode;
use Spatie\PixelMatch\Enums\Output;

beforeEach(function () {
    $this->action = new ExecuteNode();
});

it('can can execute node', function () {
    $this->action->execute(
        workingDir: realpath(dirname(__DIR__, 2)),
        arguments: [
            Output::pixels,
            'tests/fixtures/4b.png',
            'tests/fixtures/4b.png',
        ]
    );
})->expectNotToPerformAssertions();
