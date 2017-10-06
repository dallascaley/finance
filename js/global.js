$(document).ready(function() {

 	/*
 	 *	Startup
 	 */

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

    /*
     *	Transitions
     */

	$('.clicktoggle').on('click', function(e) {
		e.preventDefault();

		var elem = $('#' + $(this).data('toggle'));
		if (elem.is(":visible")) {
			elem.hide();
		} else {
			elem.show();
		}
	});

	/*
	 * Form Validation
	 */

	jQuery.validator.addMethod("mustMatch", function(value){
		return ($('input[name=password]').val() == value);
    }, "Passwords must match");

	jQuery.validator.addMethod("isEmail", function(email){
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
    }, "Invalid email format");

});