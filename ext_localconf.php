<?php

call_user_func(function () {
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['fluid_components']['namespaces']['Sitegeist\\MediaComponents\\Components'] =
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('media_components', 'Resources/Private/Components');

    $componentArgumentConverter = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \SMS\FluidComponents\Utility\ComponentArgumentConverter::class
    );
    $componentArgumentConverter->addConversionInterface(
        'float',
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromFloat::class,
        'fromFloat'
    );
    $componentArgumentConverter->addConversionInterface(
        'double',
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromFloat::class,
        'fromFloat'
    );
    $componentArgumentConverter->addConversionInterface(
        \TYPO3\CMS\Core\Imaging\ImageManipulation\Area::class,
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromArea::class,
        'fromArea'
    );
    $componentArgumentConverter->addConversionInterface(
        \SMS\FluidComponents\Domain\Model\Image::class,
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage::class,
        'fromImage'
    );
});
