<?php

namespace Sitegeist\MediaComponents\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Sitegeist\MediaComponents\Domain\Model\CropArea;
use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;

class CropAreaTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    #[Test]
    public function testFromArray(): void
    {
        $cropArea = CropArea::fromArray(['x' => 0, 'y' => 0, 'width' => 1.0, 'height' => 1.0]);

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0, 'width' => 1.0, 'height' => 1.0], $cropArea->getArea()->asArray());
    }

    #[Test]
    public function testFromFloat(): void
    {
        $cropArea = CropArea::fromFloat(2.0);

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0.25, 'width' => 1.0, 'height' => 0.5], $cropArea->getArea()->asArray());
    }

    #[Test]
    public function testFromInteger(): void
    {
        $cropArea = CropArea::fromInteger(4);

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0.375, 'width' => 1.0, 'height' => 0.25], $cropArea->getArea()->asArray());
    }

    #[Test]
    public function testFromString(): void
    {
        $cropArea = CropArea::fromString('');

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0, 'width' => 1.0, 'height' => 1.0], $cropArea->getArea()->asArray());
    }
}
