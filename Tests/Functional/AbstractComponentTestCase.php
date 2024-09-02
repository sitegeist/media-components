<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

abstract class AbstractComponentTestCase extends FunctionalTestCase
{
    protected bool $initializeDatabase = true;

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/fluid_components',
        'typo3conf/ext/media_components'
    ];

    protected array $pathsToLinkInTestInstance = [
        'typo3conf/ext/media_components/Tests/Functional/Fixtures/Files' => 'fileadmin/test_files',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->importCSVDataSet(__DIR__ . '/Fixtures/Databases/test_files.csv');
        $this->setUpBackendUser(1);
    }

    protected function cleanUpTestResult($result = '')
    {
        return trim((string) preg_replace('/\\>\\s+\\</', '><', str_replace("\n", '', (string)$result)));
    }

    protected function getTestView($html = '')
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setTemplateSource('<html
            xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
            xmlns:mc="http://typo3.org/ns/Sitegeist/MediaComponents/Components"
            xmlns:mvh="http://typo3.org/ns/Sitegeist/MediaComponents/ViewHelpers"
            data-namespace-typo3-fluid="true"
            >' . $html);

        return $view;
    }
}
