<?php

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Owlcarousel',
    [
        'Owl' => 'list',

    ],
    // non-cacheable actions
    [
        'Owl' => '',

    ]
);


/* set iconidentifier */
$iconRegistry = GeneralUtility::makeInstance(
    IconRegistry::class
);
$typeArray = [
    'ext-owl-carousel-icon'
];
foreach ($typeArray as $currentType) {
    $iconRegistry->registerIcon(
        $currentType,
        BitmapIconProvider::class,
        ['source' => 'EXT:ns_all_sliders/Resources/Public/Icons/' . $currentType . '.png']
    );
}
