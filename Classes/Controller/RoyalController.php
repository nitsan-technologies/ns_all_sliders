<?php
namespace Nsallsliders\NsAllSliders\Controller;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility as Debug;

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
 * RoyalController
 */
class RoyalController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * galleryRepository
     *
     * @var \Nsallsliders\NsAllSliders\Domain\Repository\GalleryRepository
     * @inject
     */
    protected $galleryRepository = NULL;
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        
        $config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_all_sliders']);
        if($config['jquery']){
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."js1"] = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript" /></script>';
        }

        $pluginName = $this->request->getPluginName();
        $extpath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath($this->request->getControllerExtensionKey());
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);

        if($pluginName=="Royalslider"){

            // add css js in header 
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS1"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/Royal-Slider/css/style.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS2"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/Royal-Slider/css/vendor/royalslider.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS3"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/Royal-Slider/css/vendor/skins/minimal-white/rs-minimal-white.css" />';
            
            $ajax2 = $extpath.'Resources/Public/slider/Royal-Slider/js/vendor/jquery.royalslider.min.js';
            $ajax3 = $extpath.'Resources/Public/slider/Royal-Slider/js/vendor/jquery.easing-1.3.js';

            $pageRenderer->addJsFooterFile($ajax2, 'text/javascript', FALSE, FALSE, '');
            $pageRenderer->addJsFooterFile($ajax3, 'text/javascript', FALSE, FALSE, '');
            
            // set js value for slider 
            $constant = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_nsallsliders_royalslider.']['persistence.'];
            
            $slider_type = $this->settings['slider_type'];
            $this->view->assign('slider_type', $slider_type);
            
            if($slider_type=="fullwidth"){
                
                $id="$('#full-width-slider').royalSlider({";
                $type="
                deeplinking: {
                   enabled: ".(isset($this->settings['deeplinking_enabled']) ? $this->settings['deeplinking_enabled'] : $constant['deeplinking_enabled']).",
                   change: ".(isset($this->settings['deeplinking_change']) ? $this->settings['deeplinking_change'] : $constant['deeplinking_change'])."
                },
                imgWidth: ".(isset($this->settings['slidewidth']) ? $this->settings['slidewidth'] : $constant['slidewidth']).",
                imgHeight: ".(isset($this->settings['slideheight']) ? $this->settings['slideheight'] : $constant['slideheight'])." ";

            }else if($slider_type=="fullscreen"){

                $id="$('#gallery-1').royalSlider({";
                $type="
                arrowsNavHideOnTouch: ".(isset($this->settings['arrowsNavHideOnTouch']) ? $this->settings['arrowsNavHideOnTouch'] : $constant['arrowsNavHideOnTouch']).",
                globalCaptionInside: ".(isset($this->settings['globalCaptionInside']) ? $this->settings['globalCaptionInside'] : $constant['globalCaptionInside']).",
                thumbs: {
                    appendSpan: ".(isset($this->settings['thumbs_appendSpan']) ? $this->settings['thumbs_appendSpan'] : $constant['thumbs_appendSpan']).",
                    firstMargin: ".(isset($this->settings['thumbs_firstMargin']) ? $this->settings['thumbs_firstMargin'] : $constant['thumbs_firstMargin']).",
                    paddingBottom: ".(isset($this->settings['thumbs_paddingBottom']) ? $this->settings['thumbs_paddingBottom'] : $constant['thumbs_paddingBottom'])."
                }";
            }
            
            $GLOBALS['TSFE']->additionalFooterData[$this->extKey] .= "<script> 
            ".$id."
                arrowsNav: ".(isset($this->settings['arrowsNav']) ? $this->settings['arrowsNav'] : $constant['arrowsNav']).",
                loop: ".(isset($this->settings['loop']) ? $this->settings['loop'] : $constant['loop']).",
                keyboardNavEnabled: ".(isset($this->settings['keyboardNavEnabled']) ? $this->settings['keyboardNavEnabled'] : $constant['keyboardNavEnabled']).",
                controlsInside: ".(isset($this->settings['controlsInside']) ? $this->settings['controlsInside'] : $constant['controlsInside']).",
                imageScaleMode: '".(isset($this->settings['imageScaleMode']) ? $this->settings['imageScaleMode'] : $constant['imageScaleMode'])."', 
                arrowsNavAutoHide: ".(isset($this->settings['arrowsNavAutoHide']) ? $this->settings['arrowsNavAutoHide'] : $constant['arrowsNavAutoHide']).",
                autoScaleSlider: ".(isset($this->settings['autoScaleSlider']) ? $this->settings['autoScaleSlider'] : $constant['autoScaleSlider']).",
                autoScaleSliderWidth: ".(isset($this->settings['autoScaleSliderWidth']) ? $this->settings['autoScaleSliderWidth'] : $constant['autoScaleSliderWidth']).",
                autoScaleSliderHeight: ".(isset($this->settings['autoScaleSliderHeight']) ? $this->settings['autoScaleSliderHeight'] : $constant['autoScaleSliderHeight']).",
                controlNavigation: '".(isset($this->settings['controlNavigation']) ? $this->settings['controlNavigation'] : $constant['controlNavigation'])."',
                thumbsFitInViewport: ".(isset($this->settings['thumbsFitInViewport']) ? $this->settings['thumbsFitInViewport'] : $constant['thumbsFitInViewport']).",
                navigateByClick: ".(isset($this->settings['navigateByClick']) ? $this->settings['navigateByClick'] : $constant['navigateByClick']).",
                startSlideId: ".(isset($this->settings['startSlideId']) ? $this->settings['startSlideId'] : $constant['startSlideId']).",
                autoPlay: ".(isset($this->settings['autoPlay']) ? $this->settings['autoPlay'] : $constant['autoPlay']).",
                transitionType: '".(isset($this->settings['transitionType']) ? $this->settings['transitionType'] : $constant['transitionType'])."',
                globalCaption: ".(isset($this->settings['globalCaption']) ? $this->settings['globalCaption'] : $constant['globalCaption']).",
                ".$type."
                
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