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
 * OwlController
 */
class OwlController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
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

        if($pluginName=="Owlcarousel"){
            
            // add css js in header 
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS1"] = '<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700" rel="stylesheet" type="text/css">';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS2"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/owl.carousel/assets/css/bootstrapTheme.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS3"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/owl.carousel/assets/css/custom.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS4"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/owl.carousel/owl-carousel/owl.carousel.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS5"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/owl.carousel/owl-carousel/owl.theme.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS6"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/owl.carousel/owl-carousel/owl.transitions.css" />';
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey()."CSS7"] = '<link rel="stylesheet" type="text/css" href="'.$extpath.'Resources/Public/slider/owl.carousel/assets/js/google-code-prettify/prettify.css" />';

            
            // add js at footer 
            $ajax0 = $extpath.'Resources/Public/slider/owl.carousel/owl-carousel/owl.carousel.js';
            $ajax1 = $extpath.'Resources/Public/slider/owl.carousel/assets/js/bootstrap-collapse.js';
            $ajax2 = $extpath.'Resources/Public/slider/owl.carousel/assets/js/bootstrap-transition.js';
            $ajax3 = $extpath.'Resources/Public/slider/owl.carousel/assets/js/bootstrap-tab.js';
            $ajax4 = $extpath.'Resources/Public/slider/owl.carousel/assets/js/google-code-prettify/prettify.js';
            $ajax5 = $extpath.'Resources/Public/slider/owl.carousel/assets/js/application.js';
            
            
            $pageRenderer->addJsFooterFile($ajax0, 'text/javascript', FALSE, FALSE, '');
            $pageRenderer->addJsFooterFile($ajax1, 'text/javascript', FALSE, FALSE, '');
            $pageRenderer->addJsFooterFile($ajax2, 'text/javascript', FALSE, FALSE, '');
            $pageRenderer->addJsFooterFile($ajax3, 'text/javascript', FALSE, FALSE, '');
            $pageRenderer->addJsFooterFile($ajax4, 'text/javascript', FALSE, FALSE, '');
            $pageRenderer->addJsFooterFile($ajax5, 'text/javascript', FALSE, FALSE, '');
            
            // set js value for slider 
            $constant = $GLOBALS['TSFE']->tmpl->setup['plugin.']['.tx_nsallsliders_owlcarousel.']['persistence.'];

            $GLOBALS['TSFE']->additionalFooterData[$this->extKey] .= "<script> 
                $('#owl-demo').owlCarousel({
                autoPlay : ".(isset($this->settings['autoPlay']) ? $this->settings['autoPlay'] : $constant['autoPlay']).",
                stopOnHover : ".(isset($this->settings['stopOnHover']) ? $this->settings['stopOnHover'] : $constant['stopOnHover']).",
                navigation : ".(isset($this->settings['navigation']) ? $this->settings['navigation'] : $constant['navigation']).",
                paginationSpeed : ".(isset($this->settings['paginationSpeed']) ? $this->settings['paginationSpeed'] : $constant['paginationSpeed']).",
                goToFirstSpeed : ".(isset($this->settings['goToFirstSpeed']) ? $this->settings['goToFirstSpeed'] : $constant['goToFirstSpeed']).",
                singleItem : ".(isset($this->settings['singleItem']) ? $this->settings['singleItem'] : $constant['singleItem']).",
                autoHeight : ".(isset($this->settings['autoHeight']) ? $this->settings['autoHeight'] : $constant['autoHeight']).",
                transitionStyle:'".(isset($this->settings['transitionStyle']) ? $this->settings['transitionStyle'] : $constant['transitionStyle'])."',
                items : ".(isset($this->settings['items']) ? $this->settings['items'] : $constant['items']).",
                itemsDesktop : ".(isset($this->settings['itemsDesktop']) ? $this->settings['itemsDesktop'] : $constant['itemsDesktop']).",
                itemsDesktopSmall : ".(isset($this->settings['itemsDesktopSmall']) ? $this->settings['itemsDesktopSmall'] : $constant['itemsDesktopSmall']).",
                lazyLoad : ".(isset($this->settings['lazyLoad']) ? $this->settings['lazyLoad'] : $constant['lazyLoad']).",
                slideSpeed : ".(isset($this->settings['slideSpeed']) ? $this->settings['slideSpeed'] : $constant['slideSpeed']).",
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