$(document).ready(function() {

	//Startup

	if (window.get.hasOwnProperty('step')) {
		$('.wizard.' + window.get.step).show();
	} else {
		$.get('/api/wizard', function(data) {
			if (data.message.length > 0) {
				$('.wizard.' + data.message).show();

				history.pushState(
					{step:"wizard-"+data.message},
					data.message,
					"wizard.php?step="+data.message
				);

			} else {
				$('#intro').show();
			}
		}, 'json');
	}

	$(window).bind('popstate', function(event) {
	    var state = event.originalEvent.state;
	    if (state == null) {
	    	$('.wizard').hide();
	    	$('#intro').show();
	    } else {
	    	var step_segments = state.step.split('-');
	    	var step = step_segments[1];
	    	$('#intro').hide();
	    	$('.wizard').hide();
	    	$('.wizard.' + step).show();
	    }
	});

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
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});


	$('.go_to_step').on('click', function(e) {
		e.preventDefault();
		var segments = $(this).attr('id').split('-');
		var thisForm = segments[0];
		var nextForm = segments[1];

		if ($('#intro').is(':visible')) {
			$('#intro').hide();
			$('.wizard.step1').show();

			history.pushState(
				{step:"wizard-step1"},
				'step1',
				"wizard.php?step=step1"
			);
		} else {
			if ($('#'+thisForm+'-form').valid()) {
				$('#'+thisForm+'-form').trigger('submit');

				if ($('.wizard.' + nextForm).length > 0) {
					$('.wizard').hide();
					$('.wizard.' + nextForm).show();

					history.pushState(
						{step:"wizard-"+nextForm},
						nextForm,
						"wizard.php?step="+nextForm
					);
				}
			}
		}
	});

	$('#step1-form').validate({
		rules: {
			rent: {
				required: true,
				currency: ["$", false],
			},
			rent_frequency: {notNone: true}
		}
	});

	$('#step1-form').on('submit', function(e) {
		e.preventDefault();

		var params = getFormParams('#step1-form');

		var post_params = {
			name: 'Rent',
			amount: params.rent,
			frequency: params.rent_frequency,
			days:[],
			action: 'debit'
		};

		if ($('#rent_frequency_weekday').is(':visible')) {
			post_params.days.push($('#rent_frequency_weekday').val());
		}

		if ($('#rent_frequency_day_1').is(':visible')) {
			post_params.days.push($('#rent_frequency_day_1').val());
		}

		if ($('#rent_frequency_day_2').is(':visible')) {
			post_params.days.push($('#rent_frequency_day_2').val());
		}

		$.post('/api/reoccurrence', post_params, function(response) {
			if (response.status == 'Success') {
				alert('Thank you, lets see what\'s next...');
			};
		},'json');

	});

	$('#step2-form').validate({
		rules: {
			income: {
				required: true,
				currency: ["$", false],
			},
			income_frequency: {notNone: true}
		}
	});

	$('#step2-form').on('submit', function(e) {
		e.preventDefault();

		var params = getFormParams('#step2-form');

		var post_params = {
			name: 'Pay',
			amount: params.income,
			frequency: params.income_frequency,
			day: params.income_frequency_day,
			action: 'credit'
		};

		$.post('/api/reoccurrence', post_params, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				alert('Thank you, lets see what\'s next...');
			};
		},'json');
	});


});