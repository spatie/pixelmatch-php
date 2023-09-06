<?php

namespace Spatie\PixelMatch;

class Arguments
{
    // @todo extend with output, width & height, if needed
    protected function __construct(
        public string $imagePath1,
        public string $imagePath2,
        public array $options,
    ) {
    }

    public static function fromPixelMatch(PixelMatch $pixelMatch): self
    {
        return new self(
            imagePath1: $pixelMatch->pathToImage1,
            imagePath2: $pixelMatch->pathToImage2,
            options: $pixelMatch->options(),
        );
    }

    public function toArray(): array
    {
        return [
            $this->imagePath1,
            $this->imagePath2,
            $this->options,
        ];
    }
}
