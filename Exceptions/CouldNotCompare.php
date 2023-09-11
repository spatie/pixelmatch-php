<?php

namespace Spatie\Pixelmatch\Exceptions;

use Exception;

class CouldNotCompare extends Exception
{
    public static function imageDimensionsDiffer($pathA, $pathB): self
    {
        return new static("Could not compare `{$pathA}` with `{$pathB }` as these images have different dimensions.");
    }
}
