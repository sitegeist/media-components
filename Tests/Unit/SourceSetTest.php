<?php

namespace Sitegeist\MediaComponents\Tests\Unit;

use Sitegeist\MediaComponents\Domain\Model\SourceSet;

class SourceSetTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @test
     */
    public function testFromArray()
    {
        $sourceSet = SourceSet::fromArray(['10w', '20w', '30w']);

        $this->assertInstanceOf(SourceSet::class, $sourceSet);
        $this->assertEquals(['10w', '20w', '30w'], $sourceSet->getSrcset());
    }

    /**
     * @test
     */
    public function testFromFloat()
    {
        $this->markTestIncomplete();
    }

    /**
     * @test
     */
    public function testFromInteger()
    {
        $this->markTestIncomplete();
    }

    /**
     * @test
     */
    public function testFromString()
    {
        $this->markTestIncomplete();
    }
}
