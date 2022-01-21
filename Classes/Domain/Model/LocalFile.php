<?php

namespace Sitegeist\MediaComponents\Domain\Model;

use SMS\FluidComponents\Exception\InvalidFilePathException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * Data structure for a local file resource to be passed to a component
 */
class LocalFile extends File
{
    /**
     * Type of file to differentiate implementations in Fluid templates
     *
     * @var string
     */
    protected $type = 'LocalFile';

    /**
     * Absolute path to the local file
     *
     * @var string
     */
    protected $filePath = '';

    /**
     * Creates an file object for a local file resource
     *
     * @param string $filePath
     * @throws InvalidFilePathException
     */
    public function __construct(string $filePath)
    {
        $originalFilePath = $filePath;
        $filePath = GeneralUtility::getFileAbsFileName($filePath);

        if ($filePath === '') {
            throw new InvalidFilePathException(sprintf(
                'The specified file path is invalid or is located outside of the TYPO3 context: %s',
                $originalFilePath
            ), 1562925170);
        }

        if (!file_exists($filePath)) {
            throw new InvalidFilePathException(sprintf(
                'The specified file path does not exist: %s',
                $filePath
            ), 1562925132);
        }

        $this->filePath = $filePath;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getPublicUrl(): string
    {
        return PathUtility::getAbsoluteWebPath($this->filePath);
    }
}
