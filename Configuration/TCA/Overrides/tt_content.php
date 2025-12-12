<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

$_EXTKEY = 'ns_all_sliders';

/***************
 * Plugins
 */
ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Owlcarousel',
    'Owl carousel',
    '',
    'plugins',
    '',
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml'
);
