<?php

namespace Spatie\Pixelmatch;

use InvalidArgumentException;
use Spatie\Pixelmatch\Enums\Output;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class Pixelmatch
{
    protected string $workingDirectory;

    /*
     * If true, we'll ignore anti-aliased pixels
     */
    protected bool $includeAa;

    /*
     * Smaller values make the comparison more sensitive
     */
    protected float $threshold;

    protected string $fileDir = 'bin/';

    protected string $filename = 'Pixelmatch.js';

    protected function __construct(
        public string $pathToImage1,
        public string $pathToImage2,
    ) {
        $this->workingDirectory = (string) realpath(dirname(__DIR__));
    }

    public static function new(string $pathToImage1, string $pathToImage2): self
    {
        return new static($pathToImage1, $pathToImage2);
    }

    public function includeAa(bool $includeAa = true): self
    {
        $this->includeAa = $includeAa;

        return $this;
    }

    public function threshold(float $threshold): self
    {
        if ($threshold > 1 || $threshold < 0) {
            throw new InvalidArgumentException('Threshold should be between 0 and 1');
        }

        $this->threshold = $threshold;

        return $this;
    }

    /** @return array<string, mixed> */
    public function options(): array
    {
        $options = [];

        if (isset($this->includeAa)) {
            $options['includeAA'] = $this->includeAa;
        }

        if (isset($this->threshold)) {
            $options['threshold'] = $this->threshold;
        }

        return $options;
    }

    public function matchingPercentage(): int
    {
        return $this->run(Output::Percentage);
    }

    public function mismatchingPercentage(): int
    {
        return 100 - $this->run(Output::Percentage);
    }

    public function mismatchingPixels(): int
    {
        return $this->run(Output::Pixels);
    }

    protected function run(Output $output): int
    {
        $arguments = Arguments::new($output, $this);

        $process = new Process(
            command: $this->getCommand($arguments),
            cwd: $this->workingDirectory,
        );

        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $result = $process->getOutput();

        return (int) json_decode($result, true);
    }

    /**
     * @return array<int, ?string>
     */
    protected function getCommand(Arguments $arguments): array
    {
        return [
            (new ExecutableFinder())->find('node', 'node', [
                '/usr/local/bin',
                '/opt/homebrew/bin',
            ]),
            $this->fileDir.$this->filename,
            json_encode(array_values($arguments->toArray()), JSON_THROW_ON_ERROR),
        ];
    }
}
