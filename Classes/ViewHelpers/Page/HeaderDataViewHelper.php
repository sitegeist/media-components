<?php

declare(strict_types=1);

namespace Sitegeist\MediaComponents\ViewHelpers\Page;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class HeaderDataViewHelper extends AbstractViewHelper
{
    public function render(): string
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addHeaderData($this->renderChildren());
        return '';
    }
}
