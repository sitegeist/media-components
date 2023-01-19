<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image;

use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class CropVariantViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('image', FileInterface::class, 'FAL file');
        $this->registerArgument('name', 'string', 'name of the crop variant that should be used', false, 'default');
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): Area {
        $arguments['image'] = $arguments['image'] ?? $renderChildrenClosure();
        $cropVariantCollection = CropVariantCollection::create((string)$arguments['image']->getProperty('crop'));
        return $cropVariantCollection->getCropArea($arguments['name']);
    }
}
