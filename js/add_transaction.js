$(document).ready(function() {


	$('#transaction-form').validate({
		rules: {
			transaction: {
				required: true,
				currency: ["$", false],
			},
			transaction_frequency: {notNone: true}
		}
	});

	$('#transaction-form').on('submit', function(e) {
		e.preventDefault();

		var params = getFormParams('#transaction-form');

		var post_params = {
			name: $('#name').val(),
			amount: params.transaction,
			frequency: params.transaction_frequency,
			days:[],
			action: $('input[name=type]:checked').val()
		};

		if ($('#transaction_frequency_weekday').is(':visible')) {
			post_params.days.push($('#transaction_frequency_weekday').val());
		}

		if ($('#transaction_frequency_date').is(':visible')) {
			post_params.date = $('#transaction_frequency_date').val();
		}

		if ($('#transaction_frequency_day_1').is(':visible')) {
			post_params.days.push($('#transaction_frequency_day_1').val());
		}

		if ($('#transaction_frequency_day_2').is(':visible')) {
			post_params.days.push($('#transaction_frequency_day_2').val());
		}

		console.log(post_params);

		$.post('/api/reoccurrence', post_params, function(response) {
			if (response.status == 'Success') {
				alert('Thank you');
				location.reload();
			};
		},'json');

	});
});