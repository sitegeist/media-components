<?php

call_user_func(function () {
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['fluid_components']['namespaces']['Sitegeist\\MediaComponents\\Components'] =
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('media_components', 'Resources/Private/Components');
});
