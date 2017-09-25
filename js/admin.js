$(document).ready(function() {
	$('#choose_localization').on('click', function(e) {
		e.preventDefault();
		var list = $('#localizations ul');

		if (list.find('li').length == 0) {
			$.get('/api/localization', function(response) {
			  	for(var i in response.message) {
			  		list.append('<li>' + response.message[i].name + '</li>');
			  	}

			}, 'json');
		}
	});

	$('#add_localization').on('click', function(e) {
		e.preventDefault();

		$('#localization_add_block').show();
	})

	$('#submit_localization').on('click', function(e) {
		e.preventDefault();
		var new_localization = $('input[name=localization]').val();
		$.post('/api/localization', {'localization':new_localization}, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				$('#localizations ul').append('<li>' + new_localization + '</li>');
				$('#localization_add_block').hide();
			};
		},'json');
	})
});