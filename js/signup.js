$(document).ready(function() {

	$('#signup-form').validate({
		rules: {
			username: "required",
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
		
		console.log('validate this');
	});
});