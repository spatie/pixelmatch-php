<?php

namespace Spatie\Pixelmatch\Exceptions;

use InvalidArgumentException;

class InvalidThreshold extends InvalidArgumentException
{
    public static function make(float $threshold): self
    {
        return new static("The threshold must be between 0 and 1, {$threshold} given.");
    }
}
