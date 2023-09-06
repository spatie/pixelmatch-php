<?php

namespace Spatie\PixelMatch\Concerns;

use Spatie\PixelMatch\PixelMatch;

/** @mixin PixelMatch */
trait HasOptions
{
    public readonly bool $includeAA;

    public readonly float $threshold;

    public function includeAa(bool $includeAA = true): self
    {
        $this->includeAA = $includeAA;

        return $this;
    }

    public function threshold(float $threshold): self
    {
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
