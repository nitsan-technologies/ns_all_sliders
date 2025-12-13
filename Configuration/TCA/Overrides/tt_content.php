<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

defined('TYPO3') or die();

$_EXTKEY = 'ns_all_sliders';
$versionNumber =  VersionNumberUtility::convertVersionStringToArray(VersionNumberUtility::getCurrentTypo3Version());

if($versionNumber['version_main'] <= '12') {
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
    
    /* Owlcarousel - Flexform setting  */
    $pluginSignature = str_replace('_', '', $_EXTKEY) . '_' . 'owlcarousel';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml');
}else{
    /***************
     * Plugins
     */
    $ctypeKey = ExtensionUtility::registerPlugin(
        'NsAllSliders',
        'Owlcarousel',
        'Owl Carousel',
        'ext-owl-carousel-icon',
        'plugins',
        '',
        'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml'
    );

    if ($versionNumber['version_main'] <= '13') {
        ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            '--div--;Configuration,pi_flexform,',
            $ctypeKey,
            'after:subheader'
        );

        /***************
         * FlexForms
         */
        ExtensionManagementUtility::addPiFlexFormValue(
            '*',
            'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Owlcarousel.xml',
            $ctypeKey
        );
    }
}