<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '@import \'EXT:ns_all_sliders/Configuration/TSconfig/ContentElementWizard.tsconfig\''
);
