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
        \SMS\FluidComponents\Domain\Model\Image::class,
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage::class,
        'fromImage'
    );
    $componentArgumentConverter->addConversionInterface(
        \SMS\FluidComponents\Domain\Model\FalImage::class,
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage::class,
        'fromImage'
    );
    $componentArgumentConverter->addConversionInterface(
        \SMS\FluidComponents\Domain\Model\LocalImage::class,
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage::class,
        'fromImage'
    );
    $componentArgumentConverter->addConversionInterface(
        \SMS\FluidComponents\Domain\Model\RemoteImage::class,
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage::class,
        'fromImage'
    );
    $componentArgumentConverter->addConversionInterface(
        \SMS\FluidComponents\Domain\Model\PlaceholderImage::class,
        \Sitegeist\MediaComponents\Interfaces\ConstructibleFromImage::class,
        'fromImage'
    );
});
