<?php

namespace Sitegeist\MediaComponents\Tests\Unit;

use Sitegeist\MediaComponents\Domain\Model\CropArea;
use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;

class CropAreaTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @test
     */
    public function testFromArray()
    {
        $cropArea = CropArea::fromArray([]);

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0, 'width' => 1.0, 'height' => 1.0], $cropArea->getArea()->asArray());
    }

    /**
     * @test
     */
    public function testFromFloat()
    {
        $cropArea = CropArea::fromFloat(2.0);

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0.25, 'width' => 1.0, 'height' => 0.5], $cropArea->getArea()->asArray());
    }

    /**
     * @test
     */
    public function testFromInteger()
    {
        $cropArea = CropArea::fromInteger(4);

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0.375, 'width' => 1.0, 'height' => 0.25], $cropArea->getArea()->asArray());
    }

    /**
     * @test
     */
    public function testFromString()
    {
        $cropArea = CropArea::fromString('');

        $this->assertInstanceOf(CropArea::class, $cropArea);
        $this->assertInstanceOf(Area::class, $cropArea->getArea());
        $this->assertEquals(['x' => 0, 'y' => 0, 'width' => 1.0, 'height' => 1.0], $cropArea->getArea()->asArray());
    }
}
