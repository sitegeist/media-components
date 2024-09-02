<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class PictureComponentTest extends AbstractComponentTestCase
{
    /**
     * @return string[][]
     */
    public static function pictureComponentTestProvider(): array
    {
        return [
            'Only mandatory data provided' => [
                '<picture><source srcset="fileadmin/_processed_/3/8/csm_image_a371cde464.png 1000w, fileadmin/_processed_/3/8/csm_image_a81f0ca29d.png 1200w, fileadmin/_processed_/3/8/csm_image_1bd5b4a34a.png 1400w, fileadmin/_processed_/3/8/csm_image_08822e2e11.png 1600w, fileadmin/_processed_/3/8/csm_image_a9d09d86a2.png 1800w, fileadmin/_processed_/3/8/csm_image_88e4340e66.png 2000w" /><img src="fileadmin/test_files/image.png" srcset="fileadmin/_processed_/3/8/csm_image_f221e776d0.png 400w, fileadmin/_processed_/3/8/csm_image_48d2565927.png 800w, fileadmin/_processed_/3/8/csm_image_a81f0ca29d.png 1200w" height="3840" width="3840" /></picture>',
                '<mc:picture src="{originalImage: {fileUid: 5}, srcset: \'400,800,1200\'}" sources="{desktop: {originalImage: {fileUid: 5}, srcset: \'1000, 1200, 1400, 1600, 1800, 2000\'}}" />'
            ],
            'All data provided' => [
                '<picture><source srcset="fileadmin/_processed_/3/8/csm_image_a371cde464.png 1000w, fileadmin/_processed_/3/8/csm_image_a81f0ca29d.png 1200w, fileadmin/_processed_/3/8/csm_image_1bd5b4a34a.png 1400w, fileadmin/_processed_/3/8/csm_image_08822e2e11.png 1600w, fileadmin/_processed_/3/8/csm_image_a9d09d86a2.png 1800w, fileadmin/_processed_/3/8/csm_image_88e4340e66.png 2000w" /><img src="fileadmin/_processed_/3/8/csm_image_a79b428830.png" srcset="fileadmin/_processed_/3/8/csm_image_f221e776d0.png 400w, fileadmin/_processed_/3/8/csm_image_48d2565927.png 800w, fileadmin/_processed_/3/8/csm_image_a81f0ca29d.png 1200w" height="100" width="100" alt="Alt text" title="Title text" loading="lazy" /></picture>',
                '<mc:picture
                    src="{originalImage: {fileUid: 5}, srcset: \'400,800,1200\'}"
                    sources="{desktop: {originalImage: {fileUid: 5}, srcset: \'1000, 1200, 1400, 1600, 1800, 2000\'}}"
                    width="500"
                    height="100"
                    maxDimensions="true"
                    alt="Alt text"
                    title="Title text"
                    lazyload="true"
                    preload="true"
                />'
            ]
        ];
    }

    #[Test]
    #[DataProvider('pictureComponentTestProvider')]
    public function pictureComponentTest(string $expectedResult, string $input): void {
        $view = $this->getTestView($input);
        $result = $this->cleanUpTestResult($view->render());

        $this->assertEquals($expectedResult, $result);
    }
}
