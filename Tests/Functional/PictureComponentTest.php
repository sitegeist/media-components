<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
class PictureComponentTest extends AbstractComponentTest
{
    /**
     * @test
     */
    public function pictureComponentTest() {
        $expectedResult = '<picture><source srcset="fileadmin/_processed_/3/8/csm_image_463d47849a.png 1000w, fileadmin/_processed_/3/8/csm_image_693ab61bbf.png 1200w, fileadmin/_processed_/3/8/csm_image_843c687126.png 1400w, fileadmin/_processed_/3/8/csm_image_02dd69a0b4.png 1600w, fileadmin/_processed_/3/8/csm_image_dca45b2c13.png 1800w, fileadmin/_processed_/3/8/csm_image_f471a8dcc3.png 2000w" /><img src="fileadmin/_processed_/3/8/csm_image_f5e9868174.png" srcset="fileadmin/_processed_/3/8/csm_image_eb3133aa66.png 400w, fileadmin/_processed_/3/8/csm_image_3e8ddf5a1a.png 800w, fileadmin/_processed_/3/8/csm_image_693ab61bbf.png 1200w" height="500" width="500" /></picture>';

        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplateSource('<html
            xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
            xmlns:mc="http://typo3.org/ns/Sitegeist/MediaComponents/Components"
            xmlns:mvh="http://typo3.org/ns/Sitegeist/MediaComponents/ViewHelpers"
            data-namespace-typo3-fluid="true"
            ><mc:picture src="{originalImage: {fileUid: 5}, srcset: \'400,800,1200\'}" sources="{desktop: {originalImage: {fileUid: 5}, srcset: \'1000, 1200, 1400, 1600, 1800, 2000\'}}" width="500" height="100" />');
        $result = $this->cleanUpTestResult($view->render());

        $this->assertEquals($expectedResult, $result);
    }
}
