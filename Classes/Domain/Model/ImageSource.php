<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use Sitegeist\MediaComponents\Domain\Model\CropArea;
use Sitegeist\MediaComponents\Domain\Model\SourceSet;
use Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage;
use SMS\FluidComponents\Domain\Model\FalFile;
use SMS\FluidComponents\Domain\Model\Image;
use SMS\FluidComponents\Interfaces\ConstructibleFromArray;
use SMS\FluidComponents\Interfaces\ConstructibleFromExtbaseFile;
use SMS\FluidComponents\Interfaces\ConstructibleFromFileInterface;
use SMS\FluidComponents\Interfaces\ConstructibleFromInteger;
use SMS\FluidComponents\Interfaces\ConstructibleFromString;
use SMS\FluidComponents\Interfaces\ImageWithCropVariants;
use SMS\FluidComponents\Interfaces\ImageWithDimensions;
use SMS\FluidComponents\Interfaces\ProcessableImage;
use SMS\FluidComponents\Utility\ComponentArgumentConverter;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
     * Image with applied modifications
     */
    protected ?Image $image = null;

    protected float $scale = 1.0;

    protected ?CropArea $crop = null;

    protected string $format = '';

    protected string $media = '';

    protected ?SourceSet $srcset = null;

    protected string $sizes = '';

    public function __construct(
        protected ?Image $originalImage = null
    ) {
        $this->setCrop(new CropArea);
    }

    public static function fromArray(array $value): ImageSource
    {
        $argumentConverter = GeneralUtility::makeInstance(ComponentArgumentConverter::class);

        try {
            $image = $argumentConverter->convertValueToType($value['originalImage'] ?? $value, Image::class);
        } catch (\SMS\FluidComponents\Exception\InvalidArgumentException) {
            // TODO better error handling here:
            // Image is not required, but invalid combination of parameters should
            // be catched
        }

        $imageSource = new static($image);

        if (isset($value['scale'])) {
            $imageSource->setScale((float) $value['scale']);
        }
        if (isset($value['format'])) {
            $imageSource->setFormat((string) $value['format']);
        }
        if (isset($value['media'])) {
            $imageSource->setMedia((string) $value['media']);
        }
        if (isset($value['sizes'])) {
            $imageSource->setSizes((string) $value['sizes']);
        }

        if (isset($value['crop'])) {
            $imageSource->setCrop(
                $argumentConverter->convertValueToType($value['crop'], CropArea::class)
            );
        } elseif ($image instanceof ImageWithCropVariants) {
            $cropVariant = (isset($value['cropVariant']))
                ? $image->getCropVariant($value['cropVariant'])
                : $image->getDefaultCrop();
            $imageSource->setCrop(new CropArea($cropVariant));
        }

        if (isset($value['srcset'])) {
            $imageSource->setSrcset($argumentConverter->convertValueToType($value['srcset'], SourceSet::class));
        }

        return $imageSource;
    }

    public static function fromString(string $value): ImageSource
    {
        return new static(Image::fromString($value));
    }

    public static function fromInteger(int $value): ImageSource
    {
        return new static(Image::fromInteger($value));
    }

    public static function fromFileInterface(FileInterface $file): ImageSource
    {
        return new static(Image::fromFileInterface($file));
    }

    public static function fromExtbaseFile(FileReference $fileReference): ImageSource
    {
        return new static(Image::fromExtbaseFile($fileReference));
    }

    public static function fromImage(Image $value): ImageSource
    {
        return new static($value);
    }

    public function getOriginalImage(): ?Image
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

    public function setScale(float $scale): self
    {
        $this->scale = $scale;
        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }

    public function getCrop(): CropArea
    {
        return $this->crop;
    }

    public function setCrop(CropArea $crop): self
    {
        $this->crop = $crop;
        return $this;
    }

    public function getCroppedWidth(): ?int
    {
        if (!($this->originalImage instanceof ImageWithDimensions)) {
            return null;
        }

        if ($this->crop->getArea()->isEmpty()) {
            $this->originalImage->getWidth();
        }

        if ($this->getOriginalImage() instanceof FalFile) {
            return (int) round($this->crop->getArea()->makeAbsoluteBasedOnFile($this->getOriginalImage()->getFile())->getWidth());
        }

        return (int) round($this->crop->getArea()->getWidth() * $this->originalImage->getWidth());
    }

    public function getCroppedHeight(): ?int
    {
        if (!($this->originalImage instanceof ImageWithDimensions)) {
            return null;
        }

        if ($this->crop->getArea()->isEmpty()) {
            $this->originalImage->getHeight();
        }

        if ($this->getOriginalImage() instanceof FalFile) {
            return (int) round($this->crop->getArea()->makeAbsoluteBasedOnFile($this->getOriginalImage()->getFile())->getHeight());
        }

        return (int) round($this->crop->getArea()->getHeight() * $this->originalImage->getHeight());
    }

    public function getImage(): Image
    {
        // TODO throw exception if image is not defined
        $this->processImage();
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

    public function getHeight(): ?int
    {
        $image = $this->getImage();
        return ($image instanceof ImageWithDimensions) ? $image->getHeight() : null;
    }

    public function getWidth(): ?int
    {
        $image = $this->getImage();
        return ($image instanceof ImageWithDimensions) ? $image->getWidth() : null;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(string $media): self
    {
        $this->media = $media;
        return $this;
    }

    public function getSizes(): ?string
    {
        return $this->sizes;
    }

    public function setSizes(string $sizes): self
    {
        $this->sizes = $sizes;
        return $this;
    }

    public function getSrcset(): ?SourceSet
    {
        return $this->srcset;
    }

    public function setSrcset(SourceSet $srcset): self
    {
        $this->srcset = $srcset;
        return $this;
    }

    /**
     * Use public url of image as string representation of image objects
     */
    public function __toString(): string
    {
        return $this->getPublicUrl();
    }

    protected function processImage(): void
    {
        // TODO implement runtime cache
        $this->image = null;

        $original = $this->getOriginalImage();
        if ($original instanceof ProcessableImage && $original instanceof ImageWithDimensions) {
            $this->image = $original->process(
                (int) round($this->getCroppedWidth() * $this->getScale()),
                (int) round($this->getCroppedHeight() * $this->getScale()),
                $this->getFormat(),
                $this->getCrop()->getArea(),
            );
        }
    }
}
