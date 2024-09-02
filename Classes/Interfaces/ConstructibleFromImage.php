<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Interfaces;

use SMS\FluidComponents\Domain\Model\Image;

interface ConstructibleFromImage
{
    /**
     * Creates an instance of the class based on the provided Image object
     */
    public static function fromImage(Image $value): object;
}
