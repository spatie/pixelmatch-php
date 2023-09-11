<?php

namespace Spatie\Pixelmatch;

class PixelmatchResult
{
    public function __construct(
        protected int $mismatchedPixels,
        protected int $width,
        protected int $height,
    ) {
    }

    public static function fromString(string $jsonString): self
    {
        $properties = json_decode($jsonString, true);

        return new self(
            $properties['mismatchedPixels'],
            $properties['width'],
            $properties['height'],
        );
    }

    public function totalPixels(): int
    {
        return $this->width * $this->height;
    }

    public function mismatchedPixels(): int
    {
        return $this->mismatchedPixels;
    }

    public function matchedPixels(): int
    {
        return $this->totalPixels() - $this->mismatchedPixels();
    }

    public function matchedPixelPercentage(): float
    {
        return ($this->matchedPixels() / $this->totalPixels()) * 100;
    }

    public function mismatchedPixelPercentage(): float
    {
        return 100 - $this->matchedPixelPercentage();
    }
}
