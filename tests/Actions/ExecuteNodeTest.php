<?php

namespace Spatie\Pixelmatch\Tests\Actions;

use Spatie\Pixelmatch\Actions\ExecuteNodeAction;
use Spatie\Pixelmatch\Enums\Output;

beforeEach(function () {
    $this->action = new ExecuteNodeAction();
});

it('can can execute node', function () {
    $this->action->execute(
        workingDir: realpath(dirname(__DIR__, 2)),
        arguments: [
            Output::Pixels,
            'tests/fixtures/4b.png',
            'tests/fixtures/4b.png',
        ]
    );
})->expectNotToPerformAssertions();
