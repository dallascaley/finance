$(document).ready(function() {


	$('#logout').on('click', function(e) {
		e.preventDefault();

		$.post('/api/user/logout', {}, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				location.reload();
			};
		},'json');
	});


});