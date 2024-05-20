<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die('Access denied.');

// Adding fields to the tt_content table definition in TCA
ExtensionManagementUtility::addStaticFile('ns_all_sliders', 'Configuration/TypoScript', 'All Sliders');
