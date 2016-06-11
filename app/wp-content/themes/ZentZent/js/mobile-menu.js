
// Hamburger menu animation
jQuery('.menu-wrapper').on('click', function() {
	$(this).finish().toggleClass('checked');

	if (!($('#menu').is(':visible'))) {
	    $('#menu').finish().css('opacity', '0').slideDown().animate({ opacity: 1 }, { queue: false });
	} else {
	    $('#menu').finish().css('opacity', '1').slideUp().animate({ opacity: 0 }, { queue: false });  
	}
});