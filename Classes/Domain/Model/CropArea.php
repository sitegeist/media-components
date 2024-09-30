<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use Sitegeist\MediaComponents\Interfaces\ConstructibleFromArea;
use Sitegeist\MediaComponents\Interfaces\ConstructibleFromFloat;
use SMS\FluidComponents\Interfaces\ConstructibleFromArray;
use SMS\FluidComponents\Interfaces\ConstructibleFromInteger;
use SMS\FluidComponents\Interfaces\ConstructibleFromString;
use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;
use TYPO3\CMS\Core\Imaging\ImageManipulation\Ratio;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CropArea implements ConstructibleFromArray, ConstructibleFromFloat, ConstructibleFromInteger, ConstructibleFromString, ConstructibleFromArea
{
    protected ?Area $area = null;

    public function __construct(Area $area = null)
    {
        $this->area = $area ?? Area::createEmpty();
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public static function fromArea(Area $area): static
    {
        return new static($area);
    }

    public static function fromArray(array $config): ?object
    {
        return new static(Area::createFromConfiguration($config));
    }

    public static function fromFloat(float $ratio): static
    {
        $ratio = new Ratio('', '', $ratio);
        return new static(Area::createEmpty()->applyRatioRestriction($ratio));
    }

    public static function fromInteger(int $ratio): object
    {
        $ratio = new Ratio('', '', $ratio);
        return new static(Area::createEmpty()->applyRatioRestriction($ratio));
    }

    public static function fromString(string $ratio): static
    {
        $area = Area::createEmpty();

        if (substr_count($ratio, ':') === 1) {
            [$x, $y] = GeneralUtility::trimExplode(':', $ratio);
            $area = $area->applyRatioRestriction(new Ratio('', '', (float) $x / (float) $y));
        } elseif (substr_count($ratio, '/') === 1) {
            [$x, $y] = GeneralUtility::trimExplode('/', $ratio);
            $area = $area->applyRatioRestriction(new Ratio('', '', (float) $x / (float) $y));
        }

        return new static($area);
    }
}
