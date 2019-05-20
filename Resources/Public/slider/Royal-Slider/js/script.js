$(window).load(function() {
    $('img').removeAttr('width').removeAttr('height');
});
jQuery(document).ready(function ($) {
   $('#full-width-slider').royalSlider({
        arrowsNav: true,
        loop: false,
        keyboardNavEnabled: true,
        controlsInside: false,
        imageScaleMode: 'fill',
        arrowsNavAutoHide: false,
        autoScaleSlider: true,
        autoScaleSliderWidth: 960,
        autoScaleSliderHeight: 350,
        controlNavigation: 'bullets',
        thumbsFitInViewport: false,
        navigateByClick: true,
        startSlideId: 0,
        autoPlay: false,
        transitionType: 'move',
        globalCaption: false,
        deeplinking: {
            enabled: true,
            change: false
        },
        imgWidth: 1400,
        imgHeight: 680
    });
    //jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
    $('#slider-with-blocks-1').royalSlider({
        arrowsNav: true,
        arrowsNavAutoHide: false,
        fadeinLoadedSlide: false,
        controlNavigationSpacing: 0,
        controlNavigation: 'bullets',
        imageScaleMode: 'none',
        imageAlignCenter: false,
        blockLoop: true,
        loop: true,
        numImagesToPreload: 6,
        transitionType: 'fade',
        keyboardNavEnabled: true,
        block: {
            delay: 400
        }
    });
    $('#gallery-1').royalSlider({
        
        controlNavigation: 'thumbnails',
        autoScaleSlider: true,
        loop: false,
        imageScaleMode: 'fit-if-smaller',
        navigateByClick: true,
        numImagesToPreload: 2,
        arrowsNav: true,
        arrowsNavAutoHide: true,
        arrowsNavHideOnTouch: true,
        keyboardNavEnabled: true,
        fadeinLoadedSlide: true,
        globalCaption: true,
        globalCaptionInside: false,
        thumbs: {
            appendSpan: true,
            firstMargin: true,
            paddingBottom: 4
        }
    });
});