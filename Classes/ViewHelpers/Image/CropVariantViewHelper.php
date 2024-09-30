<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image;

use Sitegeist\MediaComponents\Domain\Model\CropArea;
use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use SMS\FluidComponents\Interfaces\ImageWithCropVariants;
use SMS\FluidComponents\Interfaces\ImageWithDimensions;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CropVariantViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('image', ImageSource::class, 'Image object');
        $this->registerArgument('name', 'string', 'name of the crop variant that should be used', false, 'default');
    }

    public function render(): CropArea
    {
        $this->arguments['image'] ??= $this->renderChildren();
        if (!($this->arguments['image']->getOriginalImage() instanceof ImageWithDimensions)) {
            return $this->arguments['image'];
        }

        if ($this->arguments['image']->getOriginalImage() instanceof ImageWithCropVariants) {
            return new CropArea($this->arguments['image']->getOriginalImage()->getCropVariant($this->arguments['name']));
        } else {
            return new CropArea;
        }
    }
}
