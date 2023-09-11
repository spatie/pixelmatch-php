<?php

namespace Spatie\Pixelmatch;

use Spatie\Pixelmatch\Actions\ExecuteNodeAction;
use Spatie\Pixelmatch\Concerns\HasOptions;
use Spatie\Pixelmatch\Enums\Output;

class Pixelmatch
{
    use HasOptions;

    protected string $workingDirectory;

    protected function __construct(
        public string $pathToImage1,
        public string $pathToImage2,
        public $executeNodeAction = new ExecuteNodeAction(),
    ) {
        $this->workingDirectory = (string) realpath(dirname(__DIR__));
    }

    public static function new(string $pathToImage1, string $pathToImage2): self
    {
        return new static($pathToImage1, $pathToImage2);
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

        $result = $this->executeNodeAction->execute(
            workingDir: $this->workingDirectory,
            arguments: $arguments->toArray(),
        );

        return (int) json_decode($result, true);
    }
}
