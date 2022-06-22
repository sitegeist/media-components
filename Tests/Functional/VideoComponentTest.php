<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

class VideoComponentTest extends AbstractComponentTest
{
    /**
     * @return string[][]
     */
    public function videoComponentTestProvider(): array
    {
        return [
            'Only mandatory data provided' => [
                '<video controls="controls" preload="auto"><source src="fileadmin/test_files/video.mp4" /></video>',
                '<mc:video sources="{0: 7}" />'
            ],
            'All data provided' => [
                '<video controls="controls" loop="loop" playsinline="playsinline" width="800" height="600" preload="metadata" poster="fileadmin/test_files/image.jpg" crossorigin="anonymous"><source src="fileadmin/test_files/video.mp4" /><track src="fileadmin/test_files/subtitles.vtt" />                                        Fallback        </video>',
                '<mc:video
                    sources="{0: 7}"
                    tracks="{0: 8}"
                    width="800"
                    height="600"
                    autoplay="false"
                    controls="true"
                    loop="true"
                    muted="false"
                    poster="{fileUid: 4}"
                    preload="metadata"
                    fallbackText="Fallback"
                    crossorigin="anonymous"
                    playsinline="true"
                />'
            ]
        ];
    }

    /**
     * @test
     * @dataProvider videoComponentTestProvider
     */
    public function videoComponentTestMinimal(string $expectedResult, string $input) {
        $view = $this->getTestView($input);
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
