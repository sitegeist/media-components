<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use Sitegeist\MediaComponents\Domain\Model\SourceSet;
use SMS\FluidComponents\Interfaces\ImageWithDimensions;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class SrcsetViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('srcset', SourceSet::class, 'srcset definition');
        $this->registerArgument('base', ImageSource::class, 'Base image for pixel density calculations');
    }

    public function render(): string
    {
        if (!$this->arguments['srcset'] instanceof SourceSet) {
            return '';
        }
        $this->arguments['imageSource'] ??= $this->renderChildren();

        if (!($this->arguments['imageSource']->getOriginalImage() instanceof ImageWithDimensions)) {
            return '';
        }

        return self::generateSrcsetString($this->arguments['imageSource'], $this->arguments['srcset'], $this->arguments['base']);
    }

    public static function generateSrcsetString(ImageSource $imageSource, SourceSet $srcset, ImageSource $base = null): string
    {
        $output = [];
        $base ??= $imageSource;
        $widths = $srcset->getSrcsetAndWidths($base->getWidth());
        $localImageSource = clone $imageSource;

        foreach ($widths as $widthDescriptor => $width) {
            $localImageSource->setScale($width / $localImageSource->getCroppedWidth());
            $output[] = (string) $localImageSource . ' ' . $widthDescriptor;
        }

        return implode(', ', $output);
    }
}
