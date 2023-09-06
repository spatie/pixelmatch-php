<?php

namespace Spatie\PixelMatch;

class Options
{
    public bool $includeAA = false;

    public function includeAa(bool $includeAA = true): self
    {
        $this->includeAA = $includeAA;

        return $this;
    }
}
