<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
class AudioComponentTest extends AbstractComponentTest
{
    /**
     * @test
     */
    public function audioComponentTest() {
        $expectedResult = '<audio controls="controls" preload="auto"><source src="fileadmin/test_files/audio.mp3" /><source src="fileadmin/test_files/audio.ogg" /><source src="fileadmin/test_files/audio.ogg" /></audio>';

        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplateSource('<html
            xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
            xmlns:mc="http://typo3.org/ns/Sitegeist/MediaComponents/Components"
            xmlns:mvh="http://typo3.org/ns/Sitegeist/MediaComponents/ViewHelpers"
            data-namespace-typo3-fluid="true"
            ><mc:audio sources="{0: 1, 1: 2, 3: 2}" />');
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
