<?php

namespace Spatie\PixelMatch\Tests\Actions;

use Spatie\PixelMatch\Actions\ExecuteNode;

beforeEach(function () {
    $this->action = new ExecuteNode();
});

it('can can execute node', function () {
    $this->action->execute(
        workingDir: realpath(dirname(__DIR__, 2)),
        arguments: [
            'tests/Fixtures/Images/4b.png',
            'tests/Fixtures/Images/4b.png',
        ]
    );
})->expectNotToPerformAssertions();
