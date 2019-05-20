<?php
defined('TYPO3_MODE') or die();

$_EXTKEY = 'ns_all_sliders';

/***************
 * Plugins
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Owlcarousel',
    'Owl carousel'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Royalslider',
    'Royal Slider'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Sliderjs',
    'Sliderjs'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Nivoslider',
    'Nivoslider'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nsallsliders.' . $_EXTKEY,
    'Slickslider',
    'Slick Slider'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nitsan.' . $_EXTKEY,
    'Newscomment',
    'News Comment'
);

/* Flexform setting  */
/* Nivoslider - Flexform setting  */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'nivoslider';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Nivoslider.xml');

/* Royalslider - Flexform setting  */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'royalslider';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Royalslider.xml');

/* Sliderjs - Flexform setting  */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'sliderjs';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Sliderjs.xml');

/* Owlcarousel - Flexform setting  */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'owlcarousel';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml');

/* Slickslider - Flexform setting  */
$pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'slickslider';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Slickslider.xml');
