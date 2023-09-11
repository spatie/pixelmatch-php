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
            testImage('4b.png'),
            testImage('4b.png'),
        ]
    );
})->expectNotToPerformAssertions();
