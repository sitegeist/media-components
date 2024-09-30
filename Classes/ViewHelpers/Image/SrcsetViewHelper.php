<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use Sitegeist\MediaComponents\Domain\Model\SourceSet;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ImageService;
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
        return self::generateSrcsetString($this->arguments['imageSource'], $this->arguments['srcset'], $this->arguments['base']);
    }

    public static function generateSrcsetString(ImageSource $imageSource, SourceSet $srcset, ImageSource $base = null): string
    {
        $output = [];
        $base ??= $imageSource;
        $widths = $srcset->getSrcsetAndWidths($base->getWidth());
        $imageService = GeneralUtility::makeInstance(ImageService::class);
        $localImageSource = clone $imageSource;

        foreach ($widths as $widthDescriptor => $width) {
            $localImageSource->setScale($width / $imageSource->getOriginalImage()->getWidth());
            $output[] = $imageService->getImageUri($localImageSource->getImage()->getFile()) . ' ' . $widthDescriptor;
        }

        return implode(', ', $output);
    }
}
