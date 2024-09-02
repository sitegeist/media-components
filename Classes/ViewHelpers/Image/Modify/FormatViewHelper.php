<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image\Modify;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class FormatViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments(): void
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('format', 'string', 'File format that should be used');
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): ImageSource {
        $imageSource = $arguments['imageSource'] ?? $renderChildrenClosure();
        if ($arguments['format']) {
            $imageSourceWithFormat = clone $imageSource;
            $imageSourceWithFormat->setFormat($arguments['format']);
        }
        return $imageSourceWithFormat ?? $imageSource;
    }
}
