<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use Sitegeist\MediaComponents\Interfaces\ConstructibleFromFloat;
use SMS\FluidComponents\Interfaces\ConstructibleFromArray;
use SMS\FluidComponents\Interfaces\ConstructibleFromInteger;
use SMS\FluidComponents\Interfaces\ConstructibleFromString;

class SourceSet implements ConstructibleFromArray, ConstructibleFromFloat, ConstructibleFromInteger, ConstructibleFromString
{
    protected $srcset = [];

    public function __construct(array $srcset)
    {
        $this->setSrcset($srcset);
    }

    public function getSrcset(): array
    {
        return $this->srcset;
    }

    public function getSrcsetAndWidths(int $baseWidth): array
    {
        $srcset = [];
        foreach ($this->srcset as $widthDescriptor) {
            $srcsetMode = substr($widthDescriptor, -1);
            switch ($srcsetMode) {
                case 'x':
                    $candidateWidth = (int) ($baseWidth * (float) substr($widthDescriptor, 0, -1));

                case 'w':
                    $candidateWidth = (int) substr($widthDescriptor, 0, -1);

                default:
                    $candidateWidth = (int) $widthDescriptor;
                    $srcsetMode = 'w';
                    $widthDescriptor = $candidateWidth . 'w';
            }
            $srcset[$widthDescriptor] = $candidateWidth;
        }
        return $srcset;
    }

    public function setSrcset(array $srcset): self
    {
        $this->srcset = array_filter(array_map('trim', $srcset));
        return $this;
    }

    public static function fromArray(array $srcset)
    {
        return new static($srcset);
    }

    public static function fromFloat(float $density)
    {
        return new static([$density . 'x']);
    }

    public static function fromInteger(int $density)
    {
        return new static([$density . 'x']);
    }

    public static function fromString(string $srcset)
    {
        return new static(explode(',', $srcset));
    }
}