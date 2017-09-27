$(document).ready(function() {

	var tz = jstz.determine(); // Determines the time zone of the browser client
	var d = new Date();
	var offset = (d.getTimezoneOffset() / 60) * -1;
	console.log(offset);
    var session_data = {
    	timezone: tz.name(),
    	utc_offset: offset
    }

    $.post('/api/session', session_data, function(response) {
    	console.log(response);
	},'json');

	$('.clicktoggle').on('click', function(e) {
		e.preventDefault();

		var elem = $('#' + $(this).data('toggle'));
		if (elem.is(":visible")) {
			elem.hide();
		} else {
			elem.show();
		}
	});
});