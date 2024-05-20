<?php

use Nsallsliders\NsAllSliders\Controller\OwlController;
use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}
$_EXTKEY = 'ns_all_sliders';

ExtensionUtility::configurePlugin(
    $_EXTKEY,
    'Owlcarousel',
    [
        OwlController::class => 'list',

    ],
    // non-cacheable actions
    [
        OwlController::class => '',

    ]
);

/* set iconidentifier */
$iconRegistry = GeneralUtility::makeInstance(
    IconRegistry::class
);

$iconRegistry->registerIcon(
    'ext-owl-carousel-icon',
    BitmapIconProvider::class,
    ['source' => 'EXT:ns_all_sliders/Resources/Public/Icons/' . 'ext-owl-carousel-icon' . '.svg']
);
