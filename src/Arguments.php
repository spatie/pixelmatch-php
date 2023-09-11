<?php

namespace Spatie\Pixelmatch;

use InvalidArgumentException;
use Spatie\Pixelmatch\Enums\Output;

class Arguments
{
    /** @param  array<string, mixed>  $options */
    protected function __construct(
        public string $imagePath1,
        public string $imagePath2,
        public array $options,
        public Output $output,
    ) {
        $this->validate();
    }

    public static function new(Output $output, Pixelmatch $pixelmatch): self
    {
        return new self(
            imagePath1: $pixelmatch->pathToImage1,
            imagePath2: $pixelmatch->pathToImage2,
            options: $pixelmatch->options(),
            output: $output,
        );
    }

    /** @return array<int, mixed> */
    public function toArray(): array
    {
        return [
            $this->output,
            $this->imagePath1,
            $this->imagePath2,
            $this->options,
        ];
    }

    protected function validate(): void
    {
        $paths = [$this->imagePath1, $this->imagePath2];

        foreach ($paths as $filePath) {
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);

            if (strtolower($extension) !== 'png') {
                throw new InvalidArgumentException("File `{$filePath}` is not a .png file");
            }
        }
    }
}
