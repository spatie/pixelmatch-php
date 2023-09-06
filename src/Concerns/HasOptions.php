<?php

namespace Spatie\PixelMatch\Concerns;

use InvalidArgumentException;
use Spatie\PixelMatch\PixelMatch;

/** @mixin PixelMatch */
trait HasOptions
{
    // disables detecting and ignoring anti-aliased pixels
    protected bool $includeAA;

    // Smaller values make the comparison more sensitive
    protected float $threshold;

    public function includeAa(bool $includeAA = true): self
    {
        $this->includeAA = $includeAA;

        return $this;
    }

    public function threshold(float $threshold): self
    {
        if ($threshold > 1 || $threshold < 0) {
            throw new InvalidArgumentException('Threshold should be between 0 and 1');
        }

        $this->threshold = $threshold;

        return $this;
    }

    public function options(): array
    {
        $options = [];

        if (isset($this->includeAA)) {
            $options['includeAA'] = $this->includeAA;
        }

        if (isset($this->threshold)) {
            $options['threshold'] = $this->threshold;
        }

        return $options;
    }
}
