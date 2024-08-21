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

    private array $cssFiles = [];

    private $getContentId;

    /**
     * @return void
     */
    protected function initializeListAction(): void
    {
        $this->getContentId = $this->request->getAttribute('currentContentObject')->data['uid'];
        $this->cssFiles = [
            'EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/owl-carousel/owl.carousel.css',
            'EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/owl-carousel/owl.theme.default.css',
            'EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/owl-carousel/owl.transitions.css',
            'EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/assets/css/custom.css',
            'EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/assets/js/google-code-prettify/prettify.css',
            'EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/assets/css/animate.css'
        ];
    }

    /**
     * action list
     *
     */
    public function listAction(): ResponseInterface
    {
        $pluginName = $this->request->getPluginName();
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $this->view->assign('getContentId', $this->getContentId);

        // add css js in header
        $checkURL = GeneralUtility::getIndpEnv('TYPO3_SSL') ? 'https://' : 'http://';
        $pageRenderer->addCssFile($checkURL . 'fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700', 'stylesheet', '', '', false);

        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
        $typoScriptSetup = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $constant = $typoScriptSetup['plugin.']['tx_nsallsliders_owlcarousel.']['settings.'];
        if ($constant['jQuery']) {
            $pageRenderer->addJsFooterFile('EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/assets/js/jquery.min.js', 'text/javascript', false, false, '');
        }
        // add js at footer
        $pageRenderer->addJsFooterFile('EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/owl-carousel/owl.carousel.js', 'text/javascript', false, false, '');

        if ($this->settings['lightbox']) {
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . 'CSS8'] = $pageRenderer->addCssFile('EXT:ns_all_sliders/Resources/Public/slider/Fancybox/jquery.fancybox.min.css', 'stylesheet', '', '', false);
            $pageRenderer->addJsFooterFile('EXT:ns_all_sliders/Resources/Public/slider/Fancybox/jquery.fancybox.min.js', 'text/javascript', false, false, '');
        }
        $thumbs = '';
        if ($this->settings['thumbs']) {
            $pageRenderer->addJsFooterFile('EXT:ns_all_sliders/Resources/Public/slider/owl.carousel/assets/js/owl.carousel2.thumbs.js', 'text/javascript', false, false, '');

            $thumbs = '
                    thumbs: true,
                    thumbImage:true
                ';
        }
        $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey()] = isset($GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey()]) ? $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey()] : '';
        $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey()] .= "
                <script>
                    (function($) {
                        $('#owl-demo-" . $this->getContentId . "').owlCarousel({
                            autoplay : " . (isset($this->settings['autoPlay']) && $this->settings['autoPlay'] != '' ? $this->settings['autoPlay'] : $constant['ConAutoPlay']) . ',
                            nav : ' . (isset($this->settings['navigation']) && $this->settings['navigation'] != '' ? $this->settings['navigation'] : $constant['Connavigation']) . ',
                            items : ' . (isset($this->settings['items']) && $this->settings['items'] != '' ? $this->settings['items'] : $constant['Conitems']) . ',
                            lazyLoad : "' . (isset($this->settings['lazyLoad']) && $this->settings['lazyLoad'] != '' ? $this->settings['lazyLoad'] : $constant['ConlazyLoad']) . '",
                            mouseDrag:' . (isset($this->settings['mouseDrag']) && $this->settings['mouseDrag'] != '' ? $this->settings['mouseDrag'] : $constant['ConmouseDrag']) . ',
                            touchDrag:' . (isset($this->settings['touchDrag']) && $this->settings['touchDrag'] != '' ? $this->settings['touchDrag'] : $constant['ContouchDrag']) . ',

                            margin:' . (isset($this->settings['margin']) && $this->settings['margin'] != '' ? $this->settings['margin'] : $constant['Conmargin']) . ',
                            loop:' . (isset($this->settings['loop']) && $this->settings['loop'] != '' ? $this->settings['loop'] : $constant['Conloop']) . ',
                            pullDrag:' . (isset($this->settings['pullDrag']) && $this->settings['pullDrag'] != '' ? $this->settings['pullDrag'] : $constant['ConpullDrag']) . ',
                            freeDrag:' . (isset($this->settings['freeDrag']) && $this->settings['freeDrag'] != '' ? $this->settings['freeDrag'] : $constant['ConfreeDrag']) . ',
                            stagePadding:' . (isset($this->settings['stagePadding']) && $this->settings['stagePadding'] != '' ? $this->settings['stagePadding'] : $constant['ConstagePadding']) . ',
                            merge:' . (isset($this->settings['merge']) && $this->settings['merge'] != '' ? $this->settings['merge'] : $constant['Conmerge']) . ',
                            mergeFit:' . (isset($this->settings['mergeFit']) && $this->settings['mergeFit'] != '' ? $this->settings['mergeFit'] : $constant['ConmergeFit']) . ',
                            autoWidth:' . (isset($this->settings['autoWidth']) && $this->settings['autoWidth'] != '' ? $this->settings['autoWidth'] : $constant['ConautoWidth']) . ',
                            startPosition:' . (isset($this->settings['startPosition']) && $this->settings['startPosition'] != '' ? $this->settings['startPosition'] : $constant['ConstartPosition']) . ',
                            URLhashListener:' . (isset($this->settings['URLhashListener']) && $this->settings['URLhashListener'] != '' ? $this->settings['URLhashListener'] : $constant['ConURLhashListener']) . ',
                            rewind:' . (isset($this->settings['rewind']) && $this->settings['rewind'] != '' ? $this->settings['rewind'] : $constant['Conrewind']) . ",
                            navElement:'" . (isset($this->settings['navElement']) && $this->settings['navElement'] != '' ? $this->settings['navElement'] : $constant['ConnavElement']) . "',
                            slideBy:" . (isset($this->settings['slideBy']) && $this->settings['slideBy'] != '' ? $this->settings['slideBy'] : $constant['ConslideBy']) . ",
                            slideTransition:'" . (isset($this->settings['slideTransition']) && $this->settings['slideTransition'] != '' ? $this->settings['slideTransition'] : $constant['ConslideTransition']) . "',
                            dots:" . (isset($this->settings['dots']) && $this->settings['dots'] != '' ? $this->settings['dots'] : $constant['Condots']) . ',
                            dotsEach:' . (isset($this->settings['dotsEach']) && $this->settings['dotsEach'] != '' ? $this->settings['dotsEach'] : $constant['CondotsEach']) . ',
                            dotsData:' . (isset($this->settings['dotsData']) && $this->settings['dotsData'] != '' ? $this->settings['dotsData'] : $constant['CondotsData']) . ',
                            lazyLoadEager:' . (isset($this->settings['lazyLoadEager']) && $this->settings['lazyLoadEager'] != '' ? $this->settings['lazyLoadEager'] : $constant['ConlazyLoadEager']) . ',
                            autoplayTimeout:' . (isset($this->settings['autoplayTimeout']) && $this->settings['autoplayTimeout'] != '' ? $this->settings['autoplayTimeout'] : $constant['ConautoplayTimeout']) . ',
                            autoplayHoverPause:' . (isset($this->settings['autoplayHoverPause']) && $this->settings['autoplayHoverPause'] != '' ? $this->settings['autoplayHoverPause'] : $constant['ConautoplayHoverPause']) . ',
                            autoplaySpeed:' . (isset($this->settings['autoplaySpeed']) && $this->settings['autoplaySpeed'] != '' ? $this->settings['autoplaySpeed'] : $constant['ConautoplaySpeed']) . ',
                            navSpeed:' . (isset($this->settings['navSpeed']) && $this->settings['navSpeed'] != '' ? $this->settings['navSpeed'] : $constant['ConnavSpeed']) . ',
                            dotsSpeed:' . (isset($this->settings['dotsSpeed']) && $this->settings['dotsSpeed'] != '' ? $this->settings['dotsSpeed'] : $constant['CondotsSpeed']) . ',
                            dragEndSpeed:' . (isset($this->settings['dragEndSpeed']) && $this->settings['dragEndSpeed'] != '' ? $this->settings['dragEndSpeed'] : $constant['CondragEndSpeed']) . ",
                            smartSpeed: 450,
                            animateOut:'" . (isset($this->settings['animateOut']) && $this->settings['animateOut'] != '' ? $this->settings['animateOut'] : $constant['ConanimateOut']) . "',
                            animateIn:'" . (isset($this->settings['animateIn']) && $this->settings['animateIn'] != '' ? $this->settings['animateIn'] : $constant['ConanimateIn']) . "',
                            fallbackEasing:'" . (isset($this->settings['fallbackEasing']) && $this->settings['fallbackEasing'] != '' ? $this->settings['fallbackEasing'] : $constant['ConfallbackEasing']) . "',
                            info:" . (isset($this->settings['info']) && $this->settings['info'] != '' ? $this->settings['info'] : $constant['Coninfo']) . ',
                            nestedItemSelector:' . (isset($this->settings['nestedItemSelector']) && $this->settings['nestedItemSelector'] != '' ? $this->settings['nestedItemSelector'] : $constant['ConnestedItemSelector']) . ",

                            itemElement:'" . (isset($this->settings['itemElement']) && $this->settings['itemElement'] != '' ? $this->settings['itemElement'] : $constant['ConitemElement']) . "',
                            navContainer:" . (isset($this->settings['navContainer']) && $this->settings['navContainer'] != '' ? $this->settings['navContainer'] : $constant['ConnavContainer']) . ',
                            center:' . (isset($this->settings['center']) && $this->settings['center'] != '' ? $this->settings['center'] : $constant['Concenter']) . ',

                            dotsContainer:' . (isset($this->settings['dotsContainer']) && $this->settings['dotsContainer'] != '' ? $this->settings['dotsContainer'] : $constant['CondotsContainer']) . ',
                            checkVisible:' . (isset($this->settings['checkVisible']) && $this->settings['checkVisible'] != '' ? $this->settings['checkVisible'] : $constant['ConcheckVisible']) . ',
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


        if ($this->settings['lightbox']) {
            $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey()] .= "
                    <script>
                        // fancybox
                        // ========

                        $().fancybox({
                          selector : '.owl-item:not(.cloned) a',
                          backFocus : false
                        });
                    </script>";
        }

        //variable saved in flex form
        $this->view->assign('settings', $this->settings);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings, __FILE__.' Line '.__LINE__);
        $this->setStorageFolder($pluginName);
        return $this->htmlResponse();
    }

    /**
     * @param string $pluginName
     * @return void
     */
    private function setStorageFolder(string $pluginName): void
    {
        //set storage folder
        $pid = $this->settings['storage_pid_images'];
        if ($pid > 0) {
            $querySettings = $this->galleryRepository->createQuery()->getQuerySettings();
            $querySettings->setStoragePageIds([$pid]);
            $this->galleryRepository->setDefaultQuerySettings($querySettings);
        }

        // show all images
        $galleries = $this->galleryRepository->findAll();
        $this->view->assign('galleries', $galleries);

        // show plugin name
        $this->view->assign('pluginName', $pluginName);
    }

}
