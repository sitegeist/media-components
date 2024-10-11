<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

use SMS\FluidComponents\Domain\Model\File;
use SMS\FluidComponents\Domain\Model\Traits\FalFileTrait;

class Track extends File
{
    use FalFileTrait;

    /**
     * Type of file to differentiate implementations in Fluid templates
     */
    protected string $type = 'Track';

    protected int $default = 0;

    protected string $kind = 'subtitles';

    protected string $label = '';

    protected string $srclang = 'en';

    public function getDefault(): int
    {
        return $this->default;
    }

    public function setDefault(int $default): self
    {
        $this->default = $default;
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getSrclang(): string
    {
        return $this->srclang;
    }

    public function setSrclang(string $srclang): self
    {
        $this->srclang = $srclang;
        return $this;
    }

    public static function fromArray(array $value): self
    {
        /** @var Track $track */
        $track = parent::fromArray($value);

        $track
            ->setDefault($value['default'] ?? 0)
            ->setKind($value['kind'] ?? 'subtitles')
            ->setLabel($value['label'] ?? '')
            ->setSrclang($value['srclang'] ?? 'en');

        return $track;
    }
}
