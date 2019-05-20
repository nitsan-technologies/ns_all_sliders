<?php
namespace Nsallsliders\NsAllSliders\Controller;

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
 * SliderjsController
 */
class SliderjsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * galleryRepository
     *
     * @var \Nsallsliders\NsAllSliders\Domain\Repository\GalleryRepository
     * @inject
     */
    protected $galleryRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_all_sliders']);
        if ($config['jquery']) {
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "js1"] = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript" /></script>';
        }

        $pluginName = $this->request->getPluginName();
        $extpath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath($this->request->getControllerExtensionKey());
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);

        if ($pluginName == "Sliderjs") {
            $ajax2 = $extpath . 'Resources/Public/slider/Slides-SlidesJS/source/jquery.slides.min.js';
            $pageRenderer->addJsFooterFile($ajax2, 'text/javascript', false, false, '');

            // set js value for slider
            $constant = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_nsallsliders_sliderjs.']['persistence.'];

            $slider_type = $this->settings['slider_type'];
            $this->view->assign('slider_type', $slider_type);

            if ($slider_type == "fade") {

                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS1"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/basic-fade/css/custom.css" />';

                $type = "
                navigation: {
                  effect: '" . (isset($this->settings['navigation_effect']) ? $this->settings['navigation_effect'] : $constant['navigation_effect']) . "'
                },
                pagination: {
                  effect: '" . (isset($this->settings['pagination_effect']) ? $this->settings['pagination_effect'] : $constant['pagination_effect']) . "'
                },
                effect: {
                  fade: {
                    speed: " . (isset($this->settings['effect_fade_speed']) ? $this->settings['effect_fade_speed'] : $constant['effect_fade_speed']) . "
                  }
                }";
            } else if ($slider_type == "slide") {
                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS1"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/basic-slide/css/custom.css" />';
                $type = "";
            } else if ($slider_type == "playing") {
                // add css js in header
                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS1"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/playing/css/example.css" />';
                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS2"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/playing/css/font-awesome.min.css" />';
                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS3"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/playing/css/custom.css" />';

                $type = "
                play: {
                  active: " . (isset($this->settings['play_active']) ? $this->settings['play_active'] : $constant['play_active']) . ",
                  auto: " . (isset($this->settings['play_auto']) ? $this->settings['play_auto'] : $constant['play_auto']) . ",
                  interval: " . (isset($this->settings['play_interval']) ? $this->settings['play_interval'] : $constant['play_interval']) . ",
                  swap: " . (isset($this->settings['play_swap']) ? $this->settings['play_swap'] : $constant['play_swap']) . "
                }";
            } else if ($slider_type == "standard") {
                // add css js in header
                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS1"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/standard/css/example.css" />';
                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS2"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/standard/css/font-awesome.min.css" />';
                $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . "CSS3"] = '<link rel="stylesheet" type="text/css" href="' . $extpath . 'Resources/Public/slider/Slides-SlidesJS/types/standard/css/custom.css" />';

                $type = "navigation: '" . (isset($this->settings['navagation']) ? $this->settings['navagation'] : $constant['navagation']) . "'";
            }

            $GLOBALS['TSFE']->additionalFooterData[$this->extKey] .= "
                <script>
                    $('#slides').slidesjs({
                        width: " . (isset($this->settings['slidewidth']) ? $this->settings['slidewidth'] : $constant['slidewidth']) . ",
                        height: " . (isset($this->settings['slideheight']) ? $this->settings['slideheight'] : $constant['slideheight']) . ",
                        " . $type . "
                    });
                </script>";
        }

        //variable saved in flexform
        $this->view->assign('settings', $this->settings);

        //set storage folder
        $pid = $this->settings['storage_pid_images'];
        $querySettings = $this->galleryRepository->createQuery()->getQuerySettings();
        $querySettings->setStoragePageIds(array($pid));
        $this->galleryRepository->setDefaultQuerySettings($querySettings);

        // show all images
        $galleries = $this->galleryRepository->findAll();
        $this->view->assign('galleries', $galleries);
        // show pluging name
        $this->view->assign('pluginName', $pluginName);
    }
}
