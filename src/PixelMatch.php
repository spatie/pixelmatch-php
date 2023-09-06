<?php

namespace Spatie\PixelMatch;

use Spatie\PixelMatch\Actions\ExecuteNode;
use Spatie\PixelMatch\Concerns\HasOptions;

class PixelMatch
{
    use HasOptions;

    protected string $workingDirectory;

    protected function __construct(
        protected string $pathToImage1,
        protected string $pathToImage2,
    ) {
        $this->workingDirectory = realpath(dirname(__DIR__));
    }

    public static function new(string $pathToImage1, string $pathToImage2): self
    {
        return new static($pathToImage1, $pathToImage2);
    }

    public function compare(): int
    {
        $arguments = [
            $this->pathToImage1,
            $this->pathToImage2,
        ];

        $result = (new ExecuteNode())->execute($this->workingDirectory, $arguments);

        return (int) json_decode($result, true);
    }
}
