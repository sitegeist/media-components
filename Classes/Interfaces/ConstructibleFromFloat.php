<?php

namespace Sitegeist\MediaComponents\Interfaces;

/**
 * ConstructibleFromFloat defines an alternative constructor
 * which "converts" the provided float to the class implementing
 * the interface
 */
interface ConstructibleFromFloat
{
    /**
     * Creates an instance of the class based on the provided float
     *
     * @param float $value
     * @return object
     */
    public static function fromFloat(float $value);
}
