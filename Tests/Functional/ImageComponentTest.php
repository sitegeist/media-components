<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
class ImageComponentTest extends AbstractComponentTest
{
    /**
     * @test
     */
    public function imageComponentTest() {
        $expectedResult = '<img src="fileadmin/_processed_/3/8/csm_image_f5e9868174.png" srcset="fileadmin/_processed_/3/8/csm_image_eb3133aa66.png 400w, fileadmin/_processed_/3/8/csm_image_3e8ddf5a1a.png 800w, fileadmin/_processed_/3/8/csm_image_693ab61bbf.png 1200w" height="500" width="500" />';

        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplateSource('<html
            xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
            xmlns:mc="http://typo3.org/ns/Sitegeist/MediaComponents/Components"
            xmlns:mvh="http://typo3.org/ns/Sitegeist/MediaComponents/ViewHelpers"
            data-namespace-typo3-fluid="true"
            ><mc:image src="5" srcset="400w, 800w, 1200w" crop="1" width="500" height="100" />');
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}