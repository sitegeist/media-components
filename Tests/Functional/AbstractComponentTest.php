<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

abstract class AbstractComponentTest extends FunctionalTestCase
{
    protected $initializeDatabase = true;

    protected $testExtensionsToLoad = [
        'typo3conf/ext/fluid_components',
        'typo3conf/ext/media_components'
    ];

    protected $pathsToLinkInTestInstance = [
        'typo3_src/typo3conf/ext/media_components/Tests/Functional/Fixtures/Files' => 'fileadmin/test_files',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpBackendUserFromFixture(1);
        $this->importCSVDataSet(__DIR__ . '/Fixtures/Databases/test_files.csv');
    }

    protected function cleanUpTestResult($result = '') {
        return trim(preg_replace('/\\>\\s+\\</', '><', str_replace("\n", '', (string)$result)));
    }
}
