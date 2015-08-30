
jQuery(document).ready(function($){
	
	// setTimeout(function(){ 
	// 	window.loading_screen.finish();
	//  }, 1000);

	$('nav.main-menu').scrollToFixed({
		minWidth : 700,
	});

    $('aside,article').onScreen({
	   container: window,
	   direction: 'vertical',
	  
	   doIn: function() {
	     // Do something to the matched elements as they come in
	   },
	   doOut: function() {
	    // Do something to the matched elements as they get off scren
	   },
	   tolerance: 0,
	   throttle: 250,
	   toggleClass: 'onScreen',
	   lazyAttr: null,
	   lazyPlaceholder: 'someImage.jpg',
	   debug: false
	});

	
});	
		