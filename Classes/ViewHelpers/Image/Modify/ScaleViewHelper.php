<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image\Modify;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class ScaleViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('height', 'integer', 'Desired image height');
        $this->registerArgument('width', 'integer', 'Desired image width');
        $this->registerArgument('maxDimensions', 'boolean', 'If true, height and with will be considered maximums', true, false);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): ImageSource {
        $imageSource = $arguments['imageSource'] ?? $renderChildrenClosure();

        if ($arguments['height'] || $arguments['width']) {
            $heightFactor = $arguments['height'] / $imageSource->getOriginalImage()->getHeight();
            $widthFactor = $arguments['width'] / $imageSource->getOriginalImage()->getWidth();
            $scaleFactor = ($arguments['maxDimensions'])
                ? min($heightFactor, $widthFactor)
                : max($heightFactor, $widthFactor);

            $scaledSource = clone $imageSource;
            $scaledSource->setScale($scaleFactor);
        }

        return $scaledSource ?? $imageSource;
    }
}
