<?php

namespace Spatie\PixelMatch;

class PixelMatch
{
    protected Options $options;

    protected function __construct(
        protected string $pathToImage1,
        protected string $pathToImage2,
    ) {
        $this->options = new Options();
    }

    public static function compare(string $pathToImage1, string $pathToImage2): self
    {
        return new static($pathToImage1, $pathToImage2);
    }

    public function options(): Options
    {
        return $this->options;
    }
}
