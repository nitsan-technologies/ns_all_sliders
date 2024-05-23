<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ns_all_sliders/Resources/Private/Language/locallang_db.xlf:tx_nsallsliders_domain_model_gallery',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
        'languageField' => 'sys_language_uid',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'image,title,description,disable,',
        'iconfile' => 'EXT:ns_all_sliders/Resources/Public/Icons/tx_nsallsliders_domain_model_gallery.gif',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, title, image,fal_media, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, hidden, starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple',
                    ],
                ],
                'default' => 0,
            ],
        ],

        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_nsallsliders_domain_model_gallery',
                'foreign_table_where' => 'AND tx_nsallsliders_domain_model_gallery.pid=###CURRENT_PID### AND tx_nsallsliders_domain_model_gallery.sys_language_uid IN (-1,0)',
            ],
        ],

        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],

        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ns_all_sliders/Resources/Private/Language/locallang_db.xlf:tx_nsallsliders_domain_model_gallery.hide',
            'config' => [
                'type' => 'check',
            ],
        ],

        'starttime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ns_all_sliders/Resources/Private/Language/locallang_db.xlf:tx_nsallsliders_domain_model_gallery.startdate',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'behaviour' =>[
                    'allowLanguageSynchronization' => true
                ],
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ],

        'endtime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ns_all_sliders/Resources/Private/Language/locallang_db.xlf:tx_nsallsliders_domain_model_gallery.endddate',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'behaviour' =>[
                    'allowLanguageSynchronization' => true
                ],
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ],

        'title' => [
            'exclude' => false,
            'l10n_mode' => 'prefixLangTitle',
            'label' => 'LLL:EXT:ns_all_sliders/Resources/Private/Language/locallang_db.xlf:tx_nsallsliders_domain_model_gallery.title',
            'config' => [
                'type' => 'input',
                'eval' => 'required',
            ],
        ],

        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_all_sliders/Resources/Private/Language/locallang_db.xlf:tx_nsallsliders_domain_model_gallery.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'maxitems' => 6,
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                    ],
                    'foreign_match_fields' => [
                        'fieldname' => 'image',
                        'tablenames' => 'tx_nsallsliders_domain_model_gallery',
                        'table_local' => 'sys_file',
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            'foreign_types' => [
                                '0' => [
                                    'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                    'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                    'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                    'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                    'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                                ],
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                            ],
                        ],
                    ],
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            ),
        ],
    ],
];
