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
    'plugins'
);

/* Flexform setting  */

/* Owlcarousel - Flexform setting  */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'owlcarousel';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml');
