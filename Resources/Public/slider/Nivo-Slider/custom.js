$(window).load(function() {
    $('img').removeAttr('width').removeAttr('height');
    $('#slider').nivoSlider();
});
var arrow= $('#arrow').val();
if(arrow=='0'){
	$('#slider').hover(function(){
    	$(".nivo-directionNav a").hide();
  });
}
