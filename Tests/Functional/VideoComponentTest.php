<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
class VideoComponentTest extends AbstractComponentTest
{
    /**
     * @test
     */
    public function videoComponentTest() {
        $expectedResult = '<video controls="controls" preload="auto"><source src="fileadmin/test_files/video.mp4" /></video>';

        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplateSource('<html
            xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
            xmlns:mc="http://typo3.org/ns/Sitegeist/MediaComponents/Components"
            xmlns:mvh="http://typo3.org/ns/Sitegeist/MediaComponents/ViewHelpers"
            data-namespace-typo3-fluid="true"
            ><mc:video sources="{0: 7}" />');
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
