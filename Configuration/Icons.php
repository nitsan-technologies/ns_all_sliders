<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;

return [
    'ext-owl-carousel-icon' => [
        'provider' => BitmapIconProvider::class,
        'source' => 'EXT:ns_all_sliders/Resources/Public/Icons/ext-owl-carousel-icon.svg',
    ],
];
