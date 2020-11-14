<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image\Modify;

use Sitegeist\MediaComponents\Domain\Model\CropArea;
use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class CropViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('crop', CropArea::class, 'Crop area');
        $this->registerArgument('replace', 'boolean', 'Replace already existing crop with new crop', false, true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): ImageSource {
        $imageSource = $arguments['imageSource'] ?? $renderChildrenClosure();
        if ($arguments['crop']) {
            $croppedSource = clone $imageSource;
            // TODO check replace; combine crops
            $croppedSource->setCrop($arguments['crop']);
        }
        return $croppedSource ?? $imageSource;
    }
}
