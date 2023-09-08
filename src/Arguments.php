<?php

namespace Spatie\PixelMatch;

use InvalidArgumentException;
use Spatie\PixelMatch\Enums\Output;

class Arguments
{
    // @todo extend with output, width & height, if needed
    /** @param  array<string, mixed>  $options */
    protected function __construct(
        public string $imagePath1,
        public string $imagePath2,
        public array $options,
        public Output $output,
    ) {
        $this->validate();
    }

    public static function new(Output $output, PixelMatch $pixelMatch): self
    {
        return new self(
            imagePath1: $pixelMatch->pathToImage1,
            imagePath2: $pixelMatch->pathToImage2,
            options: $pixelMatch->options(),
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
