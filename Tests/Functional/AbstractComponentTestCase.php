<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextFactory;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;
use TYPO3Fluid\Fluid\View\TemplateView;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Extbase\Mvc\ExtbaseRequestParameters;
use TYPO3\CMS\Extbase\Mvc\Request;

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
        return trim((string) preg_replace('/\\>\\s+\\</', '><', str_replace("\n", '', (string) $result)));
    }

    protected function getTestView($html = '')
    {
        $view = new TemplateView();
        $view->setRenderingContext(
            GeneralUtility::makeInstance(RenderingContextFactory::class)->create(
                [],
                new Request(
                    (new ServerRequest)->withAttribute(
                        'extbase',
                        new ExtbaseRequestParameters
                    )
                )
            )
        );

        $view->getRenderingContext()->getViewHelperResolver()->addNamespace('mvh', 'Sitegeist\\MediaComponents\\ViewHelpers');
        $view->getRenderingContext()->getTemplatePaths()->setTemplateSource($html);

        return $view;
    }
}
