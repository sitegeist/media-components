<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

class AudioComponentTest extends AbstractComponentTest
{
    /**
     * @test
     */
    public function audioComponentTest() {
        $expectedResult = '<audio controls="controls" preload="auto"><source src="fileadmin/test_files/audio.mp3" /><source src="fileadmin/test_files/audio.ogg" /><source src="fileadmin/test_files/audio.ogg" /></audio>';

        $view = $this->getTestView('<mc:audio sources="{0: 1, 1: 2, 3: 2}" />');
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
