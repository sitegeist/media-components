<?php
declare(strict_types=1);

namespace Sitegeist\MediaComponents\Domain\Model;

class Track extends File
{
    /**
     * Default flag for track
     *
     * @var int
     */
    protected $default = 0;

    /**
     * Kind of track
     *
     * @var string
     */
    protected $kind = 'subtitles';

    /**
     * Label for the track
     *
     * @var string
     */
    protected $label = '';

    /**
     * Language of track
     *
     * @var string
     */
    protected $srclang = 'en';

    /**
     * @var string
     */
    protected $type = 'Track';


    /**
     * @return int
     */
    public function getDefault(): int
    {
        return $this->default;
    }

    /**
     * @param int $default
     */
    public function setDefault(int $default): self
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind(string $kind): self
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getSrclang(): string
    {
        return $this->srclang;
    }

    /**
     * @param string $srclang
     */
    public function setSrclang(string $srclang): self
    {
        $this->srclang = $srclang;
        return $this;
    }

    public static function fromArray(array $value): self
    {
        $file = parent::fromArray($value);
        $track = new self($file->getFile());

        $track
            ->setDefault($value['default'] ?? 0)
            ->setKind($value['kind'] ?? 'subtitles')
            ->setLabel($value['label'] ?? '')
            ->setSrclang($value['srclang'] ?? 'en');

        return $track;
    }
}
