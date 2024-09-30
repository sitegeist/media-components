<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image;

use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;
use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CropVariantViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('image', FileInterface::class, 'FAL file');
        $this->registerArgument('name', 'string', 'name of the crop variant that should be used', false, 'default');
    }

    public function render(): Area
    {
        $this->arguments['image'] ??= $this->renderChildren();
        $cropVariantCollection = CropVariantCollection::create((string)$this->arguments['image']->getProperty('crop'));
        return $cropVariantCollection->getCropArea($this->arguments['name']);
    }
}
