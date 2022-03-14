(function($) {
	
	// $ Works! You can test it with next line if you like
	// console.log($);

    // $('h1').hide()

        var $window = $(window);
        // var $pane = $('#pane1');
    
        function checkWidth() {
            var windowsize = $window.width();
            if (windowsize < 700) {
                //if the window is greater than 440px wide then turn on jScrollPane..
                var contentWidth = $('.custom_image_link').width();
                $('.video-tag').width(contentWidth);
                console.log(contentWidth)
                // alert("fired")
            }
        }
        // Execute on load
        checkWidth();
        // Bind event listener
        $(window).resize(checkWidth);
	
})( jQuery );