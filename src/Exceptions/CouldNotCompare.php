<?php

namespace Spatie\Pixelmatch\Exceptions;

use Exception;

class CouldNotCompare extends Exception
{
    public static function imageDimensionsDiffer(string $pathA, string $pathB): self
    {
        return new self("Could not compare `{$pathA}` with `{$pathB }` as these images have different dimensions.");
    }
}
