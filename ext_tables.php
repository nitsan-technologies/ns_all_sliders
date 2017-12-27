<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Nitsan AllSliders');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsallsliders_domain_model_gallery', 'EXT:ns_all_sliders/Resources/Private/Language/locallang_csh_tx_nsallsliders_domain_model_gallery.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsallsliders_domain_model_gallery');

/* Nivoslider - Flexform setting  */
$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . 'nivoslider';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Nivoslider.xml');

/* Royalslider - Flexform setting  */
$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . 'royalslider';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Royalslider.xml');

/* Sliderjs - Flexform setting  */
$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . 'sliderjs';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Sliderjs.xml');

/* Owlcarousel - Flexform setting  */
$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . 'owlcarousel';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml');

/* Slickslider - Flexform setting  */
$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . 'slickslider';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Slickslider.xml');