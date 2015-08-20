
jQuery(document).ready(function($){
	
	setTimeout(function(){ 
		window.loading_screen.finish();
	 }, 2000);

	$('nav.main-menu').scrollToFixed();

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
		