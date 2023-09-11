<?php

namespace Spatie\Pixelmatch;

use Spatie\Pixelmatch\Exceptions\InvalidImage;
use Spatie\Pixelmatch\Exceptions\InvalidThreshold;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class Pixelmatch
{
    protected string $workingDirectory;

    /*
     * If true, we'll ignore anti-aliased pixels
     */
    protected bool $includeAa = false;

    /*
     * Smaller values make the comparison more sensitive
     */
    protected float $threshold = 0.1;

    protected string $fileDir = 'bin/';

    protected string $filename = 'Pixelmatch.js';

    protected function __construct(
        public string $pathToImage1,
        public string $pathToImage2,
    ) {
        $this->workingDirectory = (string) realpath(dirname(__DIR__));

        $this->ensureValidImages();
    }

    protected function ensureValidImages(): void
    {
        $paths = [$this->pathToImage1, $this->pathToImage2];

        foreach ($paths as $filePath) {
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);

            if (! file_exists($filePath)) {
                throw InvalidImage::doesNotExist($filePath);
            }

            if (strtolower($extension) !== 'png') {
                throw InvalidImage::invalidFormat($filePath);
            }
        }
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
            throw InvalidThreshold::make($threshold);
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

    public function matchingPercentage(): float
    {
        return $this->getResult()->matchedPixelPercentage();
    }

    public function mismatchingPercentage(): float
    {
        return $this->getResult()->mismatchedPixelPercentage();
    }

    public function mismatchingPixels(): int
    {
        return $this->getResult()->mismatchedPixels();
    }

    public function getResult(): PixelmatchResult
    {
        $arguments = [
            'imagePath1' => $this->pathToImage1,
            'imagePath2' => $this->pathToImage2,
            'options' => [
                'includeAA' => $this->includeAa,
                'threshold' => $this->threshold,
            ],
        ];

        $process = new Process(
            command: $this->getCommand($arguments),
            cwd: $this->workingDirectory,
        );

        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $result = $process->getOutput();

        return PixelmatchResult::fromString($result);
    }

    /**
     * @return array<int, ?string>
     */
    protected function getCommand(array $arguments): array
    {
        return [
            (new ExecutableFinder())->find('node', 'node', [
                '/usr/local/bin',
                '/opt/homebrew/bin',
            ]),
            $this->fileDir.$this->filename,
            json_encode(array_values($arguments)),
        ];
    }
}
