<?php

use Nsallsliders\NsAllSliders\Controller\OwlController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}

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