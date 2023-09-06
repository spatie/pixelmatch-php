<?php

namespace Spatie\PixelMatch;

use Spatie\PixelMatch\Actions\ExecuteNode;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class PixelMatch
{
    protected Options $options;

    protected string $workingDirectory;

    protected function __construct(
        protected string $pathToImage1,
        protected string $pathToImage2,
    ) {
        $this->options = new Options();

        $this->workingDirectory = realpath(dirname(__DIR__).'/bin');
    }

    public static function new(string $pathToImage1, string $pathToImage2): self
    {
        return new static($pathToImage1, $pathToImage2);
    }

    public function options(): Options
    {
        return $this->options;
    }

    public function compare(): string
    {
        $arguments = [
            $this->pathToImage1,
            $this->pathToImage2,
        ];

        $result = (new ExecuteNode())->execute($this->workingDirectory, $arguments);

        return json_decode($result, true);
    }
}
