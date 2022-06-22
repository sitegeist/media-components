<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

class VideoComponentTest extends AbstractComponentTest
{
    /**
     * @test
     */
    public function videoComponentTestMinimal() {
        $expectedResult = '<video controls="controls" preload="auto"><source src="fileadmin/test_files/video.mp4" /></video>';

        $view = $this->getTestView('<mc:video sources="{0: 7}" />');
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }

    /**
     * @test
     */
    public function videoComponentTestFull() {
        $expectedResult = '<video controls="controls" loop="loop" playsinline="playsinline" width="800" height="600" preload="metadata" poster="fileadmin/test_files/image.jpg" crossorigin="anonymous"><source src="fileadmin/test_files/video.mp4" /><track src="fileadmin/test_files/subtitles.vtt" />                                        Fallback        </video>';

        $view = $this->getTestView('<mc:video
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
        />');
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
