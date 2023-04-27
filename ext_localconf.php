<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}
$_EXTKEY = 'ns_all_sliders';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    $_EXTKEY,
    'Owlcarousel',
    [
        \Nsallsliders\NsAllSliders\Controller\OwlController::class => 'list',

    ],
    // non-cacheable actions
    [
        \Nsallsliders\NsAllSliders\Controller\OwlController::class => '',

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
        ['source' => 'EXT:ns_all_sliders/Resources/Public/Icons/' . $currentType . '.svg']
    );
}
