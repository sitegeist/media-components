<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class AudioComponentTest extends AbstractComponentTestCase
{
    /**
     * @return string[][]
     */
    public static function audioComponentTestProvider(): array
    {
        return [
            'Only mandatory data provided' => [
                '<audio controls="controls" preload="auto"><source src="fileadmin/test_files/audio.mp3" type="audio/mpeg" /><source src="fileadmin/test_files/audio.ogg" type="audio/ogg" /><source src="fileadmin/test_files/audio.ogg" type="audio/ogg" /></audio>',
                '<mc:audio sources="{0: 1, 1: 2, 3: 2}" />'
            ],
            'All data provided' => [
                '<audio autoplay="autoplay" controls="controls" loop="loop" muted="muted" preload="metadata" crossorigin="anonymous"><source src="fileadmin/test_files/audio.mp3" type="audio/mpeg" /><source src="fileadmin/test_files/audio.ogg" type="audio/ogg" /><source src="fileadmin/test_files/audio.ogg" type="audio/ogg" />                        Fallback        </audio>',
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

    #[Test]
    #[DataProvider('audioComponentTestProvider')]
    public function audioComponentTest(string $expectedResult, string $input)
    {
        $view = $this->getTestView($input);
        $result = $this->cleanUpTestResult($view->render());

        $this->assertStringContainsString($expectedResult, $result);
    }
}
