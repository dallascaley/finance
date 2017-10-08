$(document).ready(function() {

	$('#signup-form').validate({
		rules: {
			username: {
				required: true,
				remote: {
                    url: "api/validate",
                    type: "get"
                }
			},
			email: {
				required: true,
				isEmail: true,
				remote: {
                    url: "api/validate",
                    type: "get"
                }
			},
			password: "required",
			password2: {mustMatch: true}
		}
	});

	$('#signup-form').on('submit', function(e) {
		e.preventDefault();
		
		var params = getFormParams('#signup-form');

		$.post('/api/user', params, function(response) {
			console.log(response);
			if (response.status == 'Success') {
				alert('Success! User has been added');
				window.location.href = 'wizard.php';
			};
		},'json');
	});
});