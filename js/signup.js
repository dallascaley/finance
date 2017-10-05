$(document).ready(function() {

	jQuery.validator.addMethod("mustMatch", function(value){
		return ($('input[name=password]').val() == value);
    }, "Passwords must match");

	$('#signup-form').validate({
		rules: {
			username: "required",
			email: "required",
			password: "required",
			password2: {mustMatch: "none"}
		}
	});

	$('#signup-form').on('submit', function(e) {
		e.preventDefault();
		
		console.log('validate this');
	});
});