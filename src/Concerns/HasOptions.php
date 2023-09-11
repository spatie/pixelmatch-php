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

    public function includeAa(bool $includeAa = true): self
    {
        $this->includeAa = $includeAa;

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

    /** @return array<string, mixed> */
    public function options(): array
    {
        $options = [];

        if (isset($this->includeAa)) {
            $options['includeAA'] = $this->includeAa;
        }

        if (isset($this->threshold)) {
            $options['threshold'] = $this->threshold;
        }

        return $options;
    }
}
