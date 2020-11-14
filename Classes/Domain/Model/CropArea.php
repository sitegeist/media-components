<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use Sitegeist\MediaComponents\Interfaces\ConstructibleFromFloat;
use SMS\FluidComponents\Interfaces\ConstructibleFromArray;
use SMS\FluidComponents\Interfaces\ConstructibleFromString;
use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;
use TYPO3\CMS\Core\Imaging\ImageManipulation\Ratio;

class CropArea implements ConstructibleFromArray, ConstructibleFromFloat, ConstructibleFromString
{
    protected $area;

    public function __construct(Area $area)
    {
        $this->area = $area;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public static function fromArray(array $config)
    {
        // TODO parse configuration
        return new static(Area::createEmpty());
    }

    public static function fromFloat(float $ratio)
    {
        $ratio = new Ratio('', '', $ratio);
        return new static(Area::createEmpty()->applyRatioRestriction($ratio));
    }

    public static function fromString(string $ratio)
    {
        // TODO parse string
        return new static(Area::createEmpty());
    }
}
