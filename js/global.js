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

	/*
	 *	Modules
	 */

	//Reoccurrence form module:

	$('.dependency').on('change', function(e) {
		var dependency_id = $(this).attr('id');
		var dependency_value = $(this).val();

		$('.depends').each(function() {
			var depends_values = $(this).attr('dependency').split(',');
			var value_sets = $(this).attr('value').split('|');
			var values = [];
			for (var i in value_sets) {
				values.push(value_sets[i].split(','));
			}
			var show = true;
			for (var q in depends_values) {
				var dependent_id = depends_values[q];

				if (dependent_id == dependency_id) {
					if (values[q].indexOf(dependency_value) == -1) {
						show = false;
					}
				} else {
					if (values[q].indexOf($('#' + dependent_id).val()) == -1) {
						show = false;
					}
				}
			}
			if (show) {
				var select = $(this).find('select');
				if (typeof select.attr('id') != 'undefined') {
					if (select.attr('id').includes("_date")) {
						select.empty();
						var day = $('#' + select.attr('from')).val();
						var d = new Date();
						var today = d.getDay();

						if (day < today) {
							var interval = 7 - (today - day);
						} else {
							var interval = day - today;
						}
						var nextTimestamp = Date.now() + (interval * 86400000);
						var dnext = new Date(nextTimestamp);
						var nextDay = dnext.getFullYear() + '-' + ('0' + (dnext.getMonth() + 1)).slice(-2) + '-' + ('0' + dnext.getDate()).slice(-2);
						var nextDisplayDay = getMonthFromJSMonthnum(dnext.getMonth()) + ' ' + jsNth(dnext.getDate());

						var followingTimestamp = Date.now() + ((interval + 7) * 86400000);
						var dfollowing = new Date(followingTimestamp);
						var followingDay = dfollowing.getFullYear() + '-' + ('0' + (dfollowing.getMonth() + 1)).slice(-2) + '-' + ('0' + dfollowing.getDate()).slice(-2);
						var followingDisplayDay = getMonthFromJSMonthnum(dfollowing.getMonth()) + ' ' + jsNth(dfollowing.getDate());

						switch (true) {
							case (today == day):
								select.append('<option value="' + nextDay + '">Today ' + nextDisplayDay + '</option');
								select.append('<option value="' + followingDay + '">Next ' + getDayFromJSDaynum(day) + ' ' + followingDisplayDay + '</option');
							break;
							case (today == (day - 1)):
								select.append('<option value="' + nextDay + '">Tomorrow ' + nextDisplayDay + '</option');
								select.append('<option value="' + followingDay + '">The Following ' + getDayFromJSDaynum(day) + ' ' + followingDisplayDay + '</option');
							break;
							default:
								select.append('<option value="' + nextDay + '">This ' + getDayFromJSDaynum(day) + ' ' + nextDisplayDay + '</option>');
								select.append('<option value="' + followingDay + '">The Following ' + getDayFromJSDaynum(day) + ' ' + followingDisplayDay + '</option');
							break;
						}
					}
				} else {
					//do we need to do anything here?
				}
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});

	$('.datepicker').datepicker();

});