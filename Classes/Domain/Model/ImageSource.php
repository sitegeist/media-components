<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use SMS\FluidComponents\Domain\Model\Image;
use TYPO3\CMS\Extbase\Service\ImageService;
use SMS\FluidComponents\Domain\Model\FalImage;
use SMS\FluidComponents\Domain\Model\LocalImage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use Sitegeist\MediaComponents\Domain\Model\CropArea;
use Sitegeist\MediaComponents\Domain\Model\SourceSet;
use SMS\FluidComponents\Domain\Model\PlaceholderImage;
use SMS\FluidComponents\Interfaces\ImageWithDimensions;
use SMS\FluidComponents\Interfaces\ConstructibleFromArray;
use SMS\FluidComponents\Interfaces\ConstructibleFromString;
use SMS\FluidComponents\Utility\ComponentArgumentConverter;
use SMS\FluidComponents\Interfaces\ConstructibleFromInteger;
use Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage;
use SMS\FluidComponents\Interfaces\ConstructibleFromExtbaseFile;
use SMS\FluidComponents\Interfaces\ConstructibleFromFileInterface;
use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;

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

    /**
     * @var string
     */
    protected $media;

    /**
     * @var SourceSet
     */
    protected $srcset;

    /**
     * @var string
     */
    protected $sizes;

    /**
     * @var ImageService
     */
    protected $imageService;

    public function __construct(Image $originalImage = null)
    {
        $this->setOriginalImage($originalImage);
        $this->imageService = GeneralUtility::makeInstance(ImageService::class);
    }

    public static function fromArray(array $value): ImageSource
    {
        $argumentConverter = GeneralUtility::makeInstance(ComponentArgumentConverter::class);

        if (isset($value['originalImage'])) {
            $image = $argumentConverter->convertValueToType($value['originalImage'], Image::class);
        }

        $imageSource = new static($image ?? null);
        $imageSource
            ->setScale($value['scale'] ?? null)
            ->setFormat($value['format'] ?? null)
            ->setMedia($value['media'] ?? null)
            ->setSizes($value['sizes'] ?? null);

        if (isset($value['crop'])) {
            $imageSource->setCrop($argumentConverter->convertValueToType($value['crop'], CropArea::class));
        }

        if (isset($value['srcset'])) {
            $imageSource->setSrcset($argumentConverter->convertValueToType($value['srcset'], SourceSet::class));
        }

        if (isset($value['cropVariant'])) {
            $imageSource->useCropVariant($value['cropVariant']);
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

    public function getOriginalImage(): ?Image
    {
        return $this->originalImage;
    }

    public function setOriginalImage(?Image $image): self
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

    public function useCropVariant(string $cropVariant): self
    {
        if (!isset($this->originalImage->getProperties()['crop'])) {
            // TODO error
            return $this;
        }

        $cropVariantCollection = CropVariantCollection::create($this->originalImage->getProperties()['crop']);
        $cropArea = $cropVariantCollection->getCropArea($cropVariant);
        $this->setCrop(new CropArea($cropArea));

        return $this;
    }

    public function getImage(): ?Image
    {
        $this->generateImage();
        return $this->image ?? $this->originalImage;
    }

    public function getPublicUrl(): string
    {
        $image = $this->getImage();

        if (!$image) {
            return '';
        }

        return $image->getPublicUrl();
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
        return ($this->getImage() instanceof ImageWithDimensions) ? $this->getImage()->getHeight() : null;
    }

    public function getWidth(): ?int
    {
        return ($this->getImage() instanceof ImageWithDimensions) ? $this->getImage()->getWidth() : null;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;
        return $this;
    }

    public function getSizes(): ?string
    {
        return $this->sizes;
    }

    public function setSizes(?string $sizes): self
    {
        $this->sizes = $sizes;
        return $this;
    }

    public function getSrcset(): ?SourceSet
    {
        return $this->srcset;
    }

    public function setSrcset(?SourceSet $srcset): self
    {
        $this->srcset = $srcset;
        return $this;
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
        $originalImage = $this->getOriginalImage();

        if ($originalImage instanceof FalImage) {
            $crop = null;
            if ($this->getCrop()) {
                $cropArea = $this->getCrop()->getArea();
                if (!$cropArea->isEmpty()) {
                    $crop = $cropArea->makeAbsoluteBasedOnFile($originalImage->getFile());
                }
            }

            $processingInstructions = [
                'width' => $originalImage->getWidth() * $this->getScale(),
                'height' => $originalImage->getHeight() * $this->getScale(),
                'fileExtension' => $this->getFormat(),
                'crop' => $crop
            ];

            $this->image = new FalImage($this->imageService->applyProcessingInstructions($originalImage->getFile(), $processingInstructions));
        } elseif ($originalImage instanceof LocalImage) {
            // TODO
        } elseif ($originalImage instanceof PlaceholderImage) {
            $this->image = new PlaceholderImage(
                $originalImage->getWidth() * $this->getScale(),
                $originalImage->getHeight() * $this->getScale()
            );
        }
    }
}
