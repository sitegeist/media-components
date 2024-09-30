<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image\Modify;

use Sitegeist\MediaComponents\Domain\Model\CropArea;
use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CropViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('crop', CropArea::class, 'Crop area');
    }

    public function render(): ImageSource
    {
        $imageSource = $this->arguments['imageSource'] ?? $this->renderChildren();
        if ($this->arguments['crop']) {
            $croppedSource = clone $imageSource;
            $croppedSource->setCrop($this->arguments['crop']);
        }
        return $croppedSource ?? $imageSource;
    }
}
