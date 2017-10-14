$(document).ready(function() {


	$('#login').validate({
		rules: {
			username: "required",
			password: "required"
		}
	});


	$('#login').on('submit', function(e) {
		e.preventDefault();

		var params = getFormParams('#login');

		var post_params = {
			username: params.username,
			password: params.password
		};

		$.post('/api/user/login', post_params, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				alert('Woohoo!');
				window.location.href = 'wizard.php';
			};
		},'json');
	});


});