<?php

defined('TYPO3') || die('Access denied.');

$_EXTKEY = 'ns_all_sliders';

// Adding fields to the tt_content table definition in TCA
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', '[Nitsan] All Sliders');
