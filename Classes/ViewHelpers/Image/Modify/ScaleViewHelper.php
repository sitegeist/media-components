<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image\Modify;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use SMS\FluidComponents\Interfaces\ImageWithDimensions;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ScaleViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('height', 'integer', 'Desired image height');
        $this->registerArgument('width', 'integer', 'Desired image width');
        $this->registerArgument('maxDimensions', 'boolean', 'If true, height and width will be considered maximums', true, false);
    }

    public function render(): ImageSource
    {
        $imageSource = $this->arguments['imageSource'] ?? $this->renderChildren();
        if (!($imageSource->getOriginalImage() instanceof ImageWithDimensions)) {
            return $imageSource;
        }
        if ($this->arguments['height'] || $this->arguments['width']) {
            $heightFactor = $this->arguments['height'] ? $this->arguments['height'] / $imageSource->getCroppedWidth() : 1;
            $widthFactor = $this->arguments['width'] ? $this->arguments['width'] / $imageSource->getCroppedHeight() : 1;
            $scaleFactor = ($this->arguments['maxDimensions'])
                ? min($heightFactor, $widthFactor)
                : max($heightFactor, $widthFactor);

            $scaledSource = clone $imageSource;
            $scaledSource->setScale($scaleFactor);
        }
        return $scaledSource ?? $imageSource;
    }
}
