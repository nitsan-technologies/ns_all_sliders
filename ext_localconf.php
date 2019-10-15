<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Owlcarousel',
    array(
        'Owl' => 'list',

    ),
    // non-cacheable actions
    array(
        'Owl' => '',

    )
);
