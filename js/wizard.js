$(document).ready(function() {

	//Startup

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

	$('.dependency').on('change', function(e) {
		var dependency_value = $(this).val();

		$('.depends').each(function() {
			var values = $(this).attr('value').split(',');

			if (values.indexOf(dependency_value) != -1) {
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
				window.location.href = 'wizard.php?step=2';
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
			name: 'Rent',
			amount: params.rent,
			frequency: params.rent_frequency,
			day: params.rent_frequency_day,
			action: 'debit'
		};

		$.post('/api/reoccurrence', post_params, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				alert('Thank you, lets see what\'s next...');
				window.location.href = 'wizard.php?step=2';
			};
		},'json');
	});


});