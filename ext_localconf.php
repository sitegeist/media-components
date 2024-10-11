<?php
declare(strict_types=1);

use Sitegeist\MediaComponents\Interfaces\ConstructibleFromArea;
use Sitegeist\MediaComponents\Interfaces\ConstructibleFromFloat;
use Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage;
use SMS\FluidComponents\Domain\Model\Image;
use SMS\FluidComponents\Utility\ComponentArgumentConverter;
use TYPO3\CMS\Core\Imaging\ImageManipulation\Area;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['fc'] ??= [];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['fc'][] = 'Sitegeist\\MediaComponents\\Components';

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['fluid_components']['namespaces']['Sitegeist\\MediaComponents\\Components'] =
    ExtensionManagementUtility::extPath('media_components', 'Resources/Private/Components');

$componentArgumentConverter = GeneralUtility::makeInstance(
    ComponentArgumentConverter::class
);
$componentArgumentConverter->addConversionInterface(
    'float',
    ConstructibleFromFloat::class,
    'fromFloat'
);
$componentArgumentConverter->addConversionInterface(
    'double',
    ConstructibleFromFloat::class,
    'fromFloat'
);
$componentArgumentConverter->addConversionInterface(
    Area::class,
    ConstructibleFromArea::class,
    'fromArea'
);
$componentArgumentConverter->addConversionInterface(
    Image::class,
    ConstructibleFromImage::class,
    'fromImage'
);
