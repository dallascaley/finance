$(document).ready(function() {

	$('#step1-form').validate({
		rules: {
			rent: {currency: ["$", false]},
			rent_frequency: {notNone: true}
		}
	});


	$('.go_to_step').on('click', function(e) {
		e.preventDefault();
		var segments = $(this).attr('id').split('-');
		var thisForm = segments[0];
		var nextForm = segments[1];

		$('#intro').hide();

		if ($('.wizard.' + nextForm).length > 0) {
			$('.wizard').hide();
			$('.wizard.' + nextForm).show();
		}
		$('#'+thisForm+'-form').trigger('submit');

		/*

		Todo:  make url change with every step,
		use this: https://stackoverflow.com/questions/824349/modify-the-url-without-reloading-the-page

		*/

	});

	$('#step1-form').on('submit', function(e) {
		e.preventDefault();

		var params = getFormParams('#step1-form');

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