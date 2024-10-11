<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class ImageComponentTest extends AbstractComponentTestCase
{
    /**
     * @return string[][]
     */
    public static function imageComponentTestProvider(): array
    {
        return [
            'Only mandatory data provided' => [
                '<img src="fileadmin/test_files/image.png" height="3840" width="3840" />',
                '<mc:image src="5" />'
            ],
            'All data provided' => [
                '<img src="fileadmin/_processed_/3/8/csm_image_3c73179ad3.jpg" srcset="fileadmin/_processed_/3/8/csm_image_2fe057fbe4.jpg 400w, fileadmin/_processed_/3/8/csm_image_00a46099c0.jpg 800w, fileadmin/_processed_/3/8/csm_image_622ce9e0c0.jpg 1200w" height="100" width="100" alt="Alt text" title="Title text" loading="lazy" sizes="(min-width: 400px) 400px, (min-width: 800px) 800px, (min-width:1200px) 1200px, 100vw" />',
                '<mc:image
                    src="5"
                    width="500"
                    height="100"
                    maxDimensions="true"
                    crop="1"
                    srcset="400w, 800w, 1200w"
                    sizes="(min-width: 400px) 400px, (min-width: 800px) 800px, (min-width:1200px) 1200px, 100vw"
                    format="jpg"
                    alt="Alt text"
                    title="Title text"
                    lazyload="true"
                    preload="true"
                />'
            ]
        ];
    }

    #[Test]
    #[DataProvider('imageComponentTestProvider')]
    public function imageComponentTest(string $expectedResult, string $input): void {
        $view = $this->getTestView($input);
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
