<?php

namespace Sitegeist\MediaComponents\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Sitegeist\MediaComponents\Domain\Model\SourceSet;

class SourceSetTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    #[Test]
    public function testFromArray(): void
    {
        $sourceSet = SourceSet::fromArray(['10w', '20w', '30w']);

        $this->assertInstanceOf(SourceSet::class, $sourceSet);
        $this->assertEquals(['10w', '20w', '30w'], $sourceSet->getSrcset());
    }

    #[Test]
    public function testFromInteger(): void
    {
        $sourceSet = SourceSet::fromInteger(200);

        $this->assertInstanceOf(SourceSet::class, $sourceSet);
        $this->assertEquals([200], $sourceSet->getSrcset());
    }

    #[Test]
    public function testFromString(): void
    {
        $sourceSet = SourceSet::fromString('10w,20w,30w');

        $this->assertInstanceOf(SourceSet::class, $sourceSet);
        $this->assertEquals(['10w', '20w', '30w'], $sourceSet->getSrcset());
    }
}
