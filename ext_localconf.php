<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
$_EXTKEY = 'ns_all_sliders';
//@extensionScannerIgnoreLine
if (version_compare(TYPO3_branch, '10.0', '>')) {
    $owlClass = \Nsallsliders\NsAllSliders\Controller\OwlController::class;
} else {
    $owlClass = 'Owl';
}
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Owlcarousel',
    [
        $owlClass => 'list',

    ],
    // non-cacheable actions
    [
        $owlClass => '',

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
