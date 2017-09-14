$(document).ready(function() {
	$('.clicktoggle').on('click', function(e) {
		var elem = $('#' + $(this).data('toggle'));
		if (elem.is(":visible")) {
			elem.hide();
		} else {
			elem.show();
		}
	})
});