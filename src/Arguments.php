<?php

namespace Spatie\Pixelmatch;

class Arguments
{
    /** @param  array<string, mixed>  $options */
    protected function __construct(
        public string $imagePath1,
        public string $imagePath2,
        public array $options,
    ) {
        $this->validate();
    }

    public static function new(Pixelmatch $pixelmatch): self
    {
        return new self(
            imagePath1: $pixelmatch->pathToImage1,
            imagePath2: $pixelmatch->pathToImage2,
            options: $pixelmatch->options(),
        );
    }

    /** @return array<int, mixed> */
    public function toArray(): array
    {
        return [
            $this->imagePath1,
            $this->imagePath2,
            $this->options,
        ];
    }

    public function toJson(): string
    {
        return json_encode(array_values($this->toArray()), JSON_THROW_ON_ERROR);
    }

    protected function validate(): void
    {
        $paths = [$this->imagePath1, $this->imagePath2];

        foreach ($paths as $filePath) {
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);

            if (! file_exists($filePath)) {
                throw InvalidImage::doesNotExist($filePath);
            }

            if (strtolower($extension) !== 'png') {
                throw InvalidImage::invalidFormat($filePath);
            }
        }
    }
}
