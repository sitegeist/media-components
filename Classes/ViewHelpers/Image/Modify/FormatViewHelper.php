<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image\Modify;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
use SMS\FluidComponents\Domain\Model\FalImage;
use SMS\FluidComponents\Domain\Model\PlaceholderImage;
use SMS\FluidComponents\Interfaces\ProcessableImage;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class FormatViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('imageSource', ImageSource::class, 'Image source (if not provided via content)');
        $this->registerArgument('format', 'string', 'File format that should be used');
    }

    public function render(): ImageSource
    {
        $imageSource = $this->arguments['imageSource'] ?? $this->renderChildren();
        if (!$this->arguments['format']
            && $imageSource->getOriginalImage() instanceof ProcessableImage
            && in_array(
                $this->getFormat($imageSource->getOriginalImage()),
                $this->getAutoWebpConversionFormats()
            )
        ) {
            $this->arguments['format'] = 'webp';
        }

        if ($this->arguments['format']) {
            $imageSourceWithFormat = clone $imageSource;
            $imageSourceWithFormat->setFormat($this->arguments['format']);
        }
        return $imageSourceWithFormat ?? $imageSource;
    }

    private function getAutoWebpConversionFormats(): array
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        return GeneralUtility::trimExplode(',', $extensionConfiguration->get('media_components', 'autoWebpConversionFormats'), true);
    }

    private function getFormat(ProcessableImage $image): string
    {
        return match (true) {
            $image instanceof PlaceholderImage => $image->getFormat(),
            $image instanceof FalImage => $image->getFile()->getExtension(),
            default => '',
        };
    }
}
