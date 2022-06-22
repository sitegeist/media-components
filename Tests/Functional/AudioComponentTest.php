<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

class AudioComponentTest extends AbstractComponentTest
{
    /**
     * @return string[][]
     */
    public function audioComponentTestProvider(): array
    {
        return [
            'Only mandatory data provided' => [
                '<audio controls="controls" preload="auto"><source src="fileadmin/test_files/audio.mp3" /><source src="fileadmin/test_files/audio.ogg" /><source src="fileadmin/test_files/audio.ogg" /></audio>',
                '<mc:audio sources="{0: 1, 1: 2, 3: 2}" />'
            ],
            'All data provided' => [
                '<audio autoplay="autoplay" controls="controls" loop="loop" muted="muted" preload="metadata" crossorigin="anonymous"><source src="fileadmin/test_files/audio.mp3" /><source src="fileadmin/test_files/audio.ogg" /><source src="fileadmin/test_files/audio.ogg" />                        Fallback        </audio>',
                '<mc:audio
                    sources="{0: 1, 1: 2, 3: 2}"
                    autoplay="true"
                    controls="true"
                    loop="true"
                    muted="true"
                    preload="metadata"
                    fallbackText="Fallback"
                    crossorigin="anonymous"
                />'
            ]
        ];
    }

    /**
     * @test
     * @dataProvider audioComponentTestProvider
     */
    public function audioComponentTest(string $expectedResult, string $input)
    {
        $view = $this->getTestView($input);
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
