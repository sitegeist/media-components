<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use Sitegeist\MediaComponents\Domain\Model\CropArea;
use Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage;
use SMS\FluidComponents\Domain\Model\Image;
use SMS\FluidComponents\Interfaces\ConstructibleFromArray;
use SMS\FluidComponents\Interfaces\ConstructibleFromExtbaseFile;
use SMS\FluidComponents\Interfaces\ConstructibleFromFileInterface;
use SMS\FluidComponents\Interfaces\ConstructibleFromInteger;
use SMS\FluidComponents\Interfaces\ConstructibleFromString;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class ImageSource implements
    ConstructibleFromArray,
    ConstructibleFromExtbaseFile,
    ConstructibleFromFileInterface,
    ConstructibleFromImage,
    ConstructibleFromInteger,
    ConstructibleFromString
{
    /**
     * Original image
     *
     * @var Image
     */
    protected $originalImage;

    /**
     * Image with applied modifications
     *
     * @var Image
     */
    protected $image;

    /**
     * @var float
     */
    protected $scale;

    /**
     * @var CropArea
     */
    protected $crop;

    /**
     * @var string
     */
    protected $format;

    public function __construct(Image $originalImage, float $scale = null, CropArea $crop = null, string $format = null)
    {
        $this
            ->setOriginalImage($originalImage)
            ->setScale($scale)
            ->setCrop($crop)
            ->setFormat($format);
    }

    public static function fromArray(array $value): ImageSource
    {
        $image = Image::fromArray($value);
        return new static($image);
    }

    public static function fromString(string $value): ImageSource
    {
        return new static(Image::fromString($value));
    }

    public static function fromInteger(int $value): ImageSource
    {
        return new static(Image::fromInteger($value));
    }

    public static function fromFileInterface(FileInterface $value): ImageSource
    {
        return new static(Image::fromFileInterface($value));
    }

    public static function fromExtbaseFile(FileReference $value): ImageSource
    {
        return new static(Image::fromExtbaseFile($value));
    }

    public static function fromImage(Image $value): ImageSource
    {
        return new static($value);
    }

    public function getOriginalImage(): Image
    {
        return $this->originalImage;
    }

    public function setOriginalImage(Image $image): self
    {
        $this->originalImage = $image;
        return $this;
    }

    public function getScale(): ?float
    {
        return $this->scale;
    }

    public function setScale(?float $scale): self
    {
        $this->scale = $scale;
        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;
        return $this;
    }

    public function getCrop(): ?CropArea
    {
        return $this->crop;
    }

    public function setCrop(?CropArea $crop): self
    {
        $this->crop = $crop;
        return $this;
    }

    public function getImage(): Image
    {
        $this->generateImage();
        return $this->image ?? $this->originalImage;
    }

    public function getPublicUrl(): string
    {
        return $this->getImage()->getPublicUrl();
    }

    public function getAlternative(): ?string
    {
        return $this->getImage()->getAlternative();
    }

    public function getTitle(): ?string
    {
        return $this->getImage()->getTitle();
    }

    public function getDescription(): ?string
    {
        return $this->getImage()->getDescription();
    }

    /**
     * Use public url of image as string representation of image objects
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getPublicUrl();
    }

    protected function generateImage(): void
    {
        // TODO calculate new image
    }
}
