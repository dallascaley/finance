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

		$.post('/api/localization', {'localization':$('input[name=localization]').val()}, function(response) {
			console.log(response);
		});
	})
});