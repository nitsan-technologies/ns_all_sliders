<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsallsliders_domain_model_gallery', 'EXT:ns_all_sliders/Resources/Private/Language/locallang_csh_tx_nsallsliders_domain_model_gallery.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsallsliders_domain_model_gallery');
