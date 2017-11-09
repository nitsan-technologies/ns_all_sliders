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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Nsallsliders.' . $_EXTKEY,
	'Royalslider',
	array(
		'Royal' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Royal' => '',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Nsallsliders.' . $_EXTKEY,
	'Sliderjs',
	array(
		'Sliderjs' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Sliderjs' => '',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Nsallsliders.' . $_EXTKEY,
	'Nivoslider',
	array(
		'Nivo' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Nivo' => '',
		
	)
);
