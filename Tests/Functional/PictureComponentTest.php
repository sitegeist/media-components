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
                '<picture><source srcset="fileadmin/_processed_/3/8/csm_image_463d47849a.png 1000w, fileadmin/_processed_/3/8/csm_image_693ab61bbf.png 1200w, fileadmin/_processed_/3/8/csm_image_843c687126.png 1400w, fileadmin/_processed_/3/8/csm_image_02dd69a0b4.png 1600w, fileadmin/_processed_/3/8/csm_image_dca45b2c13.png 1800w, fileadmin/_processed_/3/8/csm_image_f471a8dcc3.png 2000w" /><img src="fileadmin/test_files/image.png" srcset="fileadmin/_processed_/3/8/csm_image_eb3133aa66.png 400w, fileadmin/_processed_/3/8/csm_image_3e8ddf5a1a.png 800w, fileadmin/_processed_/3/8/csm_image_693ab61bbf.png 1200w" height="3840" width="3840" /></picture>',
                '<mc:picture src="{originalImage: {fileUid: 5}, srcset: \'400,800,1200\'}" sources="{desktop: {originalImage: {fileUid: 5}, srcset: \'1000, 1200, 1400, 1600, 1800, 2000\'}}" />'
            ],
            'All data provided' => [
                '<picture><source srcset="fileadmin/_processed_/3/8/csm_image_463d47849a.png 1000w, fileadmin/_processed_/3/8/csm_image_693ab61bbf.png 1200w, fileadmin/_processed_/3/8/csm_image_843c687126.png 1400w, fileadmin/_processed_/3/8/csm_image_02dd69a0b4.png 1600w, fileadmin/_processed_/3/8/csm_image_dca45b2c13.png 1800w, fileadmin/_processed_/3/8/csm_image_f471a8dcc3.png 2000w" /><img src="fileadmin/_processed_/3/8/csm_image_69c143e99c.png" srcset="fileadmin/_processed_/3/8/csm_image_eb3133aa66.png 400w, fileadmin/_processed_/3/8/csm_image_3e8ddf5a1a.png 800w, fileadmin/_processed_/3/8/csm_image_693ab61bbf.png 1200w" height="100" width="100" alt="Alt text" title="Title text" loading="lazy" /></picture>',
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
    public function pictureComponentTest(string $expectedResult, string $input) {
        $view = $this->getTestView($input);
        $result = $this->cleanUpTestResult($view->render());

        $this->assertEquals($expectedResult, $result);
    }
}
