<?php

namespace Spatie\PixelMatch\Actions;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class ExecuteNode
{
    protected string $fileDir = 'bin/';
    protected string $filename = 'pixelmatch.js';

    public function execute(
        string $workingDir,
        array $arguments
    ): string {
        $process = new Process(
            command: $this->getCommand($arguments),
            cwd: $workingDir,
        );

        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    protected function getCommand(array $arguments): array
    {
        return [
            (new ExecutableFinder())->find('node', 'node', [
                '/usr/local/bin',
                '/opt/homebrew/bin',
            ]),
            $this->fileDir . $this->filename,
            json_encode(array_values($arguments)),
        ];
    }
}
