<?php

namespace Spatie\Pixelmatch;

use InvalidArgumentException;

class InvalidImage extends InvalidArgumentException
{
    public static function invalidFormat(string $path): self
    {
        return new static("Cannot compare `{$path}` because it is not a .png file.");
    }

    public static function doesNotExist(string $path): self
    {
        return new static("There exists no file at the given path `{$path}`.");
    }
}
