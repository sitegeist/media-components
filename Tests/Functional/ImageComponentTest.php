<?php

namespace Sitegeist\MediaComponents\Tests\Functional;

use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;

class ImageComponentTest extends AbstractComponentTest
{
    protected $templateFile = 'image.html';

    /**
     * @test
     */
    public function imageComponentTest() {
        $request = $this->executeFrontendRequest((new InternalRequest())->withPageId(1));
        var_dump($request->getBody());
        var_dump($request->getBody()->getContents());
        $this->assertEquals('', $request->getBody()->getContents());
    }
}
