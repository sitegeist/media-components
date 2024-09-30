<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Image\Modify;

use Sitegeist\MediaComponents\Domain\Model\ImageSource;
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
        if ($this->arguments['format']) {
            $imageSourceWithFormat = clone $imageSource;
            $imageSourceWithFormat->setFormat($this->arguments['format']);
        }
        return $imageSourceWithFormat ?? $imageSource;
    }
}
