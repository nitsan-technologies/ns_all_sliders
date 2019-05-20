<?php
namespace Nsallsliders\NsAllSliders\Controller;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility as debug;

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
 * SlickController
 */
class SlickController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
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
        
        // debug::var_dump($pageRenderer);die;

        if($pluginName=="Slickslider"){

            // add css js in header 
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."slick"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/Slick-Slider/css/slick.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."slick-theme"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/Slick-Slider/css/slick-theme.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."slick-custom"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/Slick-Slider/css/slick-custom.css" />';
            
            // add js at footer 
            $ajax1 = $extpath.'Resources/Public/slider/Slick-Slider/js/slick.js';
            
            $pageRenderer->addJsFooterFile($ajax1, 'text/javascript', FALSE, FALSE, '');

            $GLOBALS['TSFE']->additionalFooterData[$this->extKey] .= "<script> 
                $(document).on('ready', function() {
                  $('.vertical-center-4').slick({
                    dots: ".$this->settings['dots'].",
                    vertical: true,
                    centerMode: ".$this->settings['display'].",
                    slidesToShow: 1,
                    speed: ".$this->settings['speed'].",
                    autoplay: ".$this->settings['autoplay'].",
                    autoplaySpeed: ".$this->settings['autoplaySpeed'].",
                  });
                  $('.lazy').slick({
                    lazyLoad: 'ondemand', // ondemand progressive anticipated
                    infinite: true,
                    dots: ".$this->settings['dots'].",
                    peed: ".$this->settings['speed'].",
                    autoplay: ".$this->settings['autoplay'].",
                    autoplaySpeed: ".$this->settings['autoplaySpeed'].",
                  });
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