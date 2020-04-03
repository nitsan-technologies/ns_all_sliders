<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
$_EXTKEY = 'ns_all_sliders';
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
$iconRegistry = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Imaging\IconRegistry::class
);
$typeArray = [
    'ext-owl-carousel-icon'
];
foreach ($typeArray as $currentType) {
    $iconRegistry->registerIcon(
        $currentType,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:ns_all_sliders/Resources/Public/Icons/' . $currentType . '.png']
    );
}
