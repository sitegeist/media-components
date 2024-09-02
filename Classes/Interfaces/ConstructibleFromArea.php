<?php

namespace Sitegeist\MediaComponents\Interfaces;

use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;

/**
 * ConstructibleFromArea defines an alternative constructor
 * which "converts" the provided Area object to the class implementing
 * the interface
 */
interface ConstructibleFromArea
{
    /**
     * Creates an instance of the class based on the provided Area object
     */
    public static function fromArea(Area $value): object;
}
