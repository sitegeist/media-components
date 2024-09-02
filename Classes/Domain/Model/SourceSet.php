<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use SMS\FluidComponents\Interfaces\ConstructibleFromArray;
use SMS\FluidComponents\Interfaces\ConstructibleFromInteger;
use SMS\FluidComponents\Interfaces\ConstructibleFromString;

class SourceSet implements ConstructibleFromArray, ConstructibleFromInteger, ConstructibleFromString
{
    public function __construct(protected array $srcset = [])
    {
        $this->setSrcset($srcset);
    }

    public function getSrcset(): array
    {
        return $this->srcset;
    }

    public function getSrcsetAndWidths(int $baseWidth): array
    {
        $useAbsoluteWidth = false;
        foreach ($this->srcset as $widthDescriptor) {
            if (!str_ends_with((string) $widthDescriptor, 'x')) {
                $useAbsoluteWidth = true;
                break;
            }
        }

        $srcset = [];
        foreach ($this->srcset as $widthDescriptor) {
            $srcsetMode = substr((string) $widthDescriptor, -1);
            switch ($srcsetMode) {
                // Relative dimensions
                case 'x':
                    $candidateWidth = (int) ($baseWidth * (float) substr((string) $widthDescriptor, 0, -1));
                    if ($useAbsoluteWidth === true) {
                        $widthDescriptor = $candidateWidth . 'w';
                    }
                    break;

                // Absolute dimensions
                case 'w':
                    $candidateWidth = (int) substr((string) $widthDescriptor, 0, -1);
                    break;

                default:
                    $candidateWidth = (int) $widthDescriptor;
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

    public static function fromArray(array $srcset): SourceSet
    {
        return new static($srcset);
    }

    public static function fromInteger(int $width): SourceSet
    {
        return new static([$width]);
    }

    public static function fromString(string $srcset): SourceSet
    {
        return new static(explode(',', $srcset));
    }
}
