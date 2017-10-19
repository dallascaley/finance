$(document).ready(function() {

 	/*
 	 *	Startup
 	 */

	var tz = jstz.determine(); // Determines the time zone of the browser client
	var d = new Date();
	var offset = (d.getTimezoneOffset() / 60) * -1;
    var session_data = {
    	timezone: tz.name(),
    	utc_offset: offset
    }

    $.post('/api/session', session_data, function(response) {

	},'json');

	var query_string = window.location.search.substr(1);
	var key_values = query_string.split('&');
	window.get = {};
	for (var i in key_values) {
		var parts = key_values[i].split('=');
		window.get[parts[0]] = parts[1];
	}

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

    jQuery.validator.addMethod("notNone", function(value){
		return !(value == 'none');
    }, "You must make a selection");

    /*
     * Tools
     */

     getFormParams = function(formId) {
     	var elements = $(formId).serializeArray();
		var params = {};

		for(var i in elements) {
			params[elements[i].name] = elements[i].value;
		}
		return params;
     }

     getDayFromJSDaynum = function(day) {
     	var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
     	return days[day];
     }

     getMonthFromJSMonthnum = function(month) {
     	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
     	return months[month];
     }

     jsNth = function (number) {
		if (number > 10 && number < 20) {
			return number + 'th';
		} else {
			var digit = ('0' + number).slice(-1);
			switch (digit) {
				case '1':
					return number + 'st';
				break;
				case '2':
					return number + 'nd';
				break;
				case '3':
					return number + 'rd';
				break;
				default:
					return number + 'th';
				break;
			}
		}
	}

});