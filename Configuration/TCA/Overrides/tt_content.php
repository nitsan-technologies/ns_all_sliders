<?php
defined('TYPO3') or die();

$_EXTKEY = 'ns_all_sliders';

/***************
 * Plugins
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Owlcarousel',
    'Owl carousel'
);

/* Flexform setting  */

/* Owlcarousel - Flexform setting  */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'owlcarousel';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml');
