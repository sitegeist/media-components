<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image;

use Sitegeist\MediaComponents\Domain\Model\CropArea;
use SMS\FluidComponents\Interfaces\ImageWithCropVariants;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class CropVariantViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('image', ImageSource::class, 'Image object');
        $this->registerArgument('name', 'string', 'name of the crop variant that should be used', false, 'default');
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): CropArea {
        $arguments['image'] = $arguments['image'] ?? $renderChildrenClosure();
        if ($arguments['image'] instanceof ImageWithCropVariants) {
            return new CropArea($arguments['image']->getCropVariant($arguments['name']));
        } else {
            return new CropArea;
        }
    }
}
