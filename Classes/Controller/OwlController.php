<?php

namespace Nsallsliders\NsAllSliders\Controller;

use Nsallsliders\NsAllSliders\Domain\Repository\GalleryRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * OwlController
 */
class OwlController extends ActionController
{
    public function __construct(
        protected GalleryRepository $galleryRepository
    )
    {
    }


    /**
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $currentContentObject = $this->request->getAttribute('currentContentObject');
        $getContentId = $currentContentObject->data['uid'];
        $settings = $this->settings;
        $extkey = $this->request->getControllerExtensionKey();

        $owlCarouselPath = 'EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/';  

        $checkURL = GeneralUtility::getIndpEnv('TYPO3_SSL') ? 'https://' : 'http://';
        $cssFiles = [
            'CSS1' => $checkURL . 'fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700',
            'CSS3' => 'assets/css/custom.css',
            'CSS4' => 'owl-carousel/owl.carousel.css',
            'CSS5' => 'owl-carousel/owl.theme.default.css',
            'CSS6' => 'owl-carousel/owl.transitions.css',
            'CSS7' => 'assets/js/google-code-prettify/prettify.css',
            'CSS9' => 'assets/css/animate.css'
        ];

        foreach ($cssFiles as $index => $cssFile) {
            $GLOBALS['TSFE']->additionalHeaderData[$extkey . $index] =
                $pageRenderer->addCssFile(
                    $index == 'CSS1' ? $cssFile : $owlCarouselPath.$cssFile,
                    'stylesheet',
                    '',
                    '',
                    false
                );
        }

        // set js value for slider
        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
        $typoScriptSetup = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $constant = $typoScriptSetup['plugin.']['tx_nsallsliders_owlcarousel.']['settings.'];

        if ($constant['jQuery']) {
            $pageRenderer->addJsFooterFile(
                $owlCarouselPath.'assets/js/jquery.min.js',
                'text/javascript',
                false
            );
        }
        // add js at footer
        $pageRenderer->addJsFooterFile(
            $owlCarouselPath.'owl-carousel/owl.carousel.js',
            'text/javascript',
            false
        );

        $sliderJsPath = 'EXT:ns_all_sliders/Resources/Public/slider/';
        if ($settings['lightbox']) {
            $GLOBALS['TSFE']->additionalHeaderData[$extkey . 'CSS8'] = $pageRenderer->addCssFile(
                $sliderJsPath.'Fancybox/jquery.fancybox.min.css',
                'stylesheet',
                '',
                '',
                false
            );

            $pageRenderer->addJsFooterFile(
                $sliderJsPath.'Fancybox/jquery.fancybox.min.js',
                'text/javascript',
                false
            );
        }
        $thumbs = '';
        if ($settings['thumbs']) {
            $pageRenderer->addJsFooterFile(
                $sliderJsPath.'owl.carousel/assets/js/owl.carousel2.thumbs.js',
                'text/javascript',
                false
            );
            $thumbs = '
                thumbs: true,
                thumbImage:true
            ';
        }

        $GLOBALS['TSFE']->additionalFooterData[$extkey] = isset($GLOBALS['TSFE']->additionalFooterData[$extkey]) ? $GLOBALS['TSFE']->additionalFooterData[$extkey] : '';
        $GLOBALS['TSFE']->additionalFooterData[$extkey] .= "
            <script>
                (function($) {
                    $('#owl-demo-" . $getContentId . "').owlCarousel({
                        autoplay : " . (isset($settings['autoPlay']) && $settings['autoPlay'] != '' ? $settings['autoPlay'] : $constant['ConAutoPlay']) . ',
                        nav : ' . (isset($settings['navigation']) && $settings['navigation'] != '' ? $settings['navigation'] : $constant['Connavigation']) . ',
                        items : ' . (isset($settings['items']) && $settings['items'] != '' ? $settings['items'] : $constant['Conitems']) . ',
                        lazyLoad : "' . (isset($settings['lazyLoad'])  && $settings['lazyLoad'] != '' ? $settings['lazyLoad'] : $constant['ConlazyLoad']) . '",
                        mouseDrag:' . (isset($settings['mouseDrag']) && $settings['mouseDrag'] != '' ? $settings['mouseDrag'] : $constant['ConmouseDrag']) . ',
                        touchDrag:' . (isset($settings['touchDrag']) && $settings['touchDrag'] != '' ? $settings['touchDrag'] : $constant['ContouchDrag']) . ',

                        margin:' . (isset($settings['margin']) && $settings['margin'] != '' ? $settings['margin'] : $constant['Conmargin']) . ',
                        loop:' . (isset($settings['loop']) && $settings['loop'] != '' ? $settings['loop'] : $constant['Conloop']) . ',
                        pullDrag:' . (isset($settings['pullDrag']) && $settings['pullDrag'] != '' ? $settings['pullDrag'] : $constant['ConpullDrag']) . ',
                        freeDrag:' . (isset($settings['freeDrag']) && $settings['freeDrag'] != '' ? $settings['freeDrag'] : $constant['ConfreeDrag']) . ',
                        stagePadding:' . (isset($settings['stagePadding']) && $settings['stagePadding'] != '' ? $settings['stagePadding'] : $constant['ConstagePadding']) . ',
                        merge:' . (isset($settings['merge']) && $settings['merge'] != '' ? $settings['merge'] : $constant['Conmerge']) . ',
                        mergeFit:' . (isset($settings['mergeFit']) && $settings['mergeFit'] != '' ? $settings['mergeFit'] : $constant['ConmergeFit']) . ',
                        autoWidth:' . (isset($settings['autoWidth']) && $settings['autoWidth'] != '' ? $settings['autoWidth'] : $constant['ConautoWidth']) . ',
                        startPosition:' . (isset($settings['startPosition']) && $settings['startPosition'] != '' ? $settings['startPosition'] : $constant['ConstartPosition']) . ',
                        URLhashListener:' . (isset($settings['URLhashListener']) && $settings['URLhashListener'] != '' ? $settings['URLhashListener'] : $constant['ConURLhashListener']) . ',
                        rewind:' . (isset($settings['rewind']) && $settings['rewind'] != '' ? $settings['rewind'] : $constant['Conrewind']) . ",
                        navElement:'" . (isset($settings['navElement']) && $settings['navElement'] != '' ? $settings['navElement'] : $constant['ConnavElement']) . "',
                        slideBy:" . (isset($settings['slideBy']) && $settings['slideBy'] != '' ? $settings['slideBy'] : $constant['ConslideBy']) . ",
                        slideTransition:'" . (isset($settings['slideTransition']) && $settings['slideTransition'] != '' ? $settings['slideTransition'] : $constant['ConslideTransition']) . "',
                        dots:" . (isset($settings['dots']) && $settings['dots'] != '' ? $settings['dots'] : $constant['Condots']) . ',
                        dotsEach:' . (isset($settings['dotsEach']) && $settings['dotsEach'] != '' ? $settings['dotsEach'] : $constant['CondotsEach']) . ',
                        dotsData:' . (isset($settings['dotsData']) && $settings['dotsData'] != '' ? $settings['dotsData'] : $constant['CondotsData']) . ',
                        lazyLoadEager:' . (isset($settings['lazyLoadEager']) && $settings['lazyLoadEager'] != '' ? $settings['lazyLoadEager'] : $constant['ConlazyLoadEager']) . ',
                        autoplayTimeout:' . (isset($settings['autoplayTimeout']) && $settings['autoplayTimeout'] != '' ? $settings['autoplayTimeout'] : $constant['ConautoplayTimeout']) . ',
                        autoplayHoverPause:' . (isset($settings['autoplayHoverPause']) && $settings['autoplayHoverPause'] != '' ? $settings['autoplayHoverPause'] : $constant['ConautoplayHoverPause']) . ',
                        autoplaySpeed:' . (isset($settings['autoplaySpeed']) && $settings['autoplaySpeed'] != '' ? $settings['autoplaySpeed'] : $constant['ConautoplaySpeed']) . ',
                        navSpeed:' . (isset($settings['navSpeed']) && $settings['navSpeed'] != '' ? $settings['navSpeed'] : $constant['ConnavSpeed']) . ',
                        dotsSpeed:' . (isset($settings['dotsSpeed']) && $settings['dotsSpeed'] != '' ? $settings['dotsSpeed'] : $constant['CondotsSpeed']) . ',
                        dragEndSpeed:' . (isset($settings['dragEndSpeed']) && $settings['dragEndSpeed'] != '' ? $settings['dragEndSpeed'] : $constant['CondragEndSpeed']) . ",
                        smartSpeed: 450,
                        animateOut:'" . (isset($settings['animateOut']) && $settings['animateOut'] != '' ? $settings['animateOut'] : $constant['ConanimateOut']) . "',
                        animateIn:'" . (isset($settings['animateIn']) && $settings['animateIn'] != '' ? $settings['animateIn'] : $constant['ConanimateIn']) . "',
                        fallbackEasing:'" . (isset($settings['fallbackEasing']) && $settings['fallbackEasing'] != '' ? $settings['fallbackEasing'] : $constant['ConfallbackEasing']) . "',
                        info:" . (isset($settings['info']) && $settings['info'] != '' ? $settings['info'] : $constant['Coninfo']) . ',
                        nestedItemSelector:' . (isset($settings['nestedItemSelector']) && $settings['nestedItemSelector'] != '' ? $settings['nestedItemSelector'] : $constant['ConnestedItemSelector']) . ",

                        itemElement:'" . (isset($settings['itemElement']) && $settings['itemElement'] != '' ? $settings['itemElement'] : $constant['ConitemElement']) . "',
                        navContainer:" . (isset($settings['navContainer']) && $settings['navContainer'] != '' ? $settings['navContainer'] : $constant['ConnavContainer']) . ',
                        center:' . (isset($settings['center']) && $settings['center'] != '' ? $settings['center'] : $constant['Concenter']) . ',

                        dotsContainer:' . (isset($settings['dotsContainer']) && $settings['dotsContainer'] != '' ? $settings['dotsContainer'] : $constant['CondotsContainer']) . ',
                        checkVisible:' . (isset($settings['checkVisible']) && $settings['checkVisible'] != '' ? $settings['checkVisible'] : $constant['ConcheckVisible']) . ',
                        ' . $thumbs . "
                    });
                })(jQuery);
                function makePages() {
                    $.each(this.owl.userItems, function(i) {
                        $('.owl-controls .owl-page').eq(i)
                            .css({
                                'background': 'url(' + $(this).find('img').attr('src') + ')',
                                'background-size': 'cover'
                            })
                    });
                }
            </script>";

        if ($settings['lightbox']) {
            $GLOBALS['TSFE']->additionalFooterData[$extkey] .= "
                <script>
                    // fancybox
                    $().fancybox({
                      selector : '.owl-item:not(.cloned) a',
                      backFocus : false
                    });
                </script>";
        }

        //set storage folder
        $pid = $settings['storage_pid_images'];
        if ($pid > 0) {
            $querySettings = $this->galleryRepository->createQuery()->getQuerySettings();
            $querySettings->setStoragePageIds([$pid]);
            $this->galleryRepository->setDefaultQuerySettings($querySettings);
        }

        // show all images
        $galleries = $this->galleryRepository->findAll();
        $this->view->assignMultiple([
            'galleries' => $galleries,
            'settings' => $settings,
            'getContentId' => $getContentId

        ]);
        return $this->htmlResponse();
    }
}