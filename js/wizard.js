$(document).ready(function() {

	//Startup

	if (window.get.hasOwnProperty('step')) {
		$('.wizard.' + window.get.step).show();
	} else {
		$.get('/api/wizard', function(data) {
			if (data.message.length > 0) {
				$('.wizard.' + data.message).show();
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

		if ($('#rent_frequency_date').is(':visible')) {
			post_params.date = $('#rent_frequency_date').val();
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
			days: [],
			action: 'credit'
		};

		if ($('#income_frequency_weekday').is(':visible')) {
			post_params.days.push($('#income_frequency_weekday').val());
		}

		if ($('#income_frequency_date').is(':visible')) {
			post_params.date = $('#income_frequency_date').val();
			post_params.datetype = 'start';
		}

		if ($('#income_frequency_day_1').is(':visible')) {
			post_params.days.push($('#income_frequency_day_1').val());
		}

		if ($('#income_frequency_day_2').is(':visible')) {
			post_params.days.push($('#income_frequency_day_2').val());
		}

		if ($('#transaction_date_1').is(':visible')) {
			post_params.date_1 = $('#income_frequency_date_1').val();
			post_params.datetype = 'first';
		}

		if ($('#transaction_date_2').is(':visible')) {
			post_params.date_2 = $('#income_frequency_date_2').val();
			post_params.datetype = 'second';
		}
		
		console.log(post_params);

		$.post('/api/reoccurrence', post_params, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				alert('Thank you, lets see what\'s next...');
			};
		},'json');

	});


});