$(document).ready(function() {

	$('#step1-form').validate({
		rules: {
			rent: "required",
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
		var params = getFormParams('#'+thisForm+'-form');

		$.post('/api/user', params, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				alert('Success! User has been added');
				window.location.href = 'wizard.php';
			};
		},'json');
		*/

	});

	$('#step1-form').on('submit', function(e) {
		e.preventDefault();

		var params = getFormParams('#step1-form');

		$.post('/api/reoccurrence', params, function(response) {
			console.log(response);

			/*
			if (response.status == 'Success') {
				alert('Success! User has been added');
				window.location.href = 'wizard.php';
			};
			*/
		},'json');
	});


});