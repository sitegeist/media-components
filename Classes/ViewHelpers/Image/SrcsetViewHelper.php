<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use Sitegeist\MediaComponents\Domain\Model\SourceSet;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class SrcsetViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('srcset', SourceSet::class, 'srcset definition');
        $this->registerArgument('base', ImageSource::class, 'Base image for pixel density calculations');
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        $arguments['imageSource'] = $arguments['imageSource'] ?? $renderChildrenClosure();

        return self::generateSrcsetString($arguments['imageSource'], $arguments['srcset'], $arguments['base']);
    }

    public static function generateSrcsetString(ImageSource $imageSource, SourceSet $srcset, ImageSource $base = null): string
    {
        $output = [];
        $base = $base ?? $imageSource;
        $widths = $srcset->getSrcsetAndWidths($base->getWidth());

        foreach ($widths as $widthDescriptor => $width) {
            $imageSource->setScale($width / $imageSource->getOriginalImage()->getWidth());
            $output[] = '/' . $imageSource->getPublicUrl() . ' ' . $widthDescriptor;
        }

        return implode(', ', $output);
    }
}
