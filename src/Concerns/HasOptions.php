<?php

namespace Spatie\Pixelmatch\Concerns;

use InvalidArgumentException;
use Spatie\Pixelmatch\Pixelmatch;

/** @mixin Pixelmatch */
trait HasOptions
{
    /*
     * If true, we'll ignore anti-aliased pixels
     */
    protected bool $includeAa;

    /*
     * Smaller values make the comparison more sensitive
     */
    protected float $threshold;
}
