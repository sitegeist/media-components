<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

abstract class AbstractComponentTest extends FunctionalTestCase
{
    protected $initializeDatabase = true;

    protected $testExtensionsToLoad = [
        'typo3conf/ext/fluid_components'
    ];

    protected $pathsToLinkInTestInstance = [
        'typo3_src/typo3conf/ext/media_components/Tests/Functional/Fixtures/Files' => 'fileadmin/test_files',
    ];

    protected $templateFile = '';

    public function setUp(): void
    {
        parent::setUp();
        $this->importCSVDataSet(__DIR__ . '/Fixtures/Databases/test_files.csv');
        $this->setUpFrontendRootPage(1, [], ['config' => '
            page = PAGE
            page {
               config.disableAllHeaderCode = 0
               10 = FLUIDTEMPLATE
               10 {
                  file = EXT:media_components/Tests/Functional/Fixtures/Templates/' . $this->templateFile . '
               }
            }
        ']);
    }
}
