
$(document).ready(function() {

	var scroll = new SmoothScroll('a[href*="#"]', {
    	speed: 300
    });
		
	//handle external links (new window)
	$('a[href^=http]').bind('click',function(){
		window.open($(this).attr('href'));
		return false;
	});
	
    // make code pretty
    window.prettyPrint && prettyPrint();
	
});