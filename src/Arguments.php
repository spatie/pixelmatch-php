<?php

namespace Spatie\PixelMatch;

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
        // @todo validate input
        // Do images exist and are .png
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
}
