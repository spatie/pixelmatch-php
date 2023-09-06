<?php

namespace Spatie\PixelMatch;

use Spatie\PixelMatch\Actions\ExecuteNode;
use Spatie\PixelMatch\Concerns\HasOptions;

class PixelMatch
{
    use HasOptions;

    protected string $workingDirectory;

    protected function __construct(
        public readonly string $pathToImage1,
        public readonly string $pathToImage2,
    ) {
        $this->workingDirectory = realpath(dirname(__DIR__));
    }

    public static function new(string $pathToImage1, string $pathToImage2): self
    {
        return new static($pathToImage1, $pathToImage2);
    }

    public function matchingPercentage(): int
    {
        return $this->run();
    }

    public function mismatchingPercentage(): int
    {
        return 100 - $this->run();
    }

    protected function run(): int
    {
        $arguments = Arguments::fromPixelMatch($this);

        $result = (new ExecuteNode())->execute($this->workingDirectory, $arguments->toArray());

        return (int) json_decode($result, true);
    }
}
