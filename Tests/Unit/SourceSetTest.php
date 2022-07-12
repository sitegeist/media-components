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
        $sourceSet = SourceSet::fromFloat(0.5);

        $this->assertInstanceOf(SourceSet::class, $sourceSet);
        $this->assertEquals(['0.5x'], $sourceSet->getSrcset());
    }

    /**
     * @test
     */
    public function testFromInteger()
    {
        $sourceSet = SourceSet::fromInteger(2);

        $this->assertInstanceOf(SourceSet::class, $sourceSet);
        $this->assertEquals(['2x'], $sourceSet->getSrcset());
    }

    /**
     * @test
     */
    public function testFromString()
    {
        $sourceSet = SourceSet::fromString('10w,20w,30w');

        $this->assertInstanceOf(SourceSet::class, $sourceSet);
        $this->assertEquals(['10w', '20w', '30w'], $sourceSet->getSrcset());
    }
}
