jQuery('document').ready(function() {

	var $allFootnotes = $('.footnote');
	var i = 0;

	if ($allFootnotes.length !== 0) {
		jQuery.each($allFootnotes, function(key, value) {
			i++;
			$(this).find('.footnote-number').text('[' + i + ']')
		});
	}
});