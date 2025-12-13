<?php

use Nsallsliders\NsAllSliders\Controller\OwlController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}

$versionNumber =  VersionNumberUtility::convertVersionStringToArray(VersionNumberUtility::getCurrentTypo3Version());
if($versionNumber['version_main'] <= '12') {
    ExtensionUtility::configurePlugin(
        'ns_all_sliders',
        'Owlcarousel',
        [
            OwlController::class => 'list',
        ],
        // non-cacheable actions
        [
            OwlController::class => '',
        ]
    );
} else {
    ExtensionUtility::configurePlugin(
        'ns_all_sliders',
        'Owlcarousel',
        [
            OwlController::class => 'list',
        ],
        // non-cacheable actions
        [
            OwlController::class => '',
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );
}
