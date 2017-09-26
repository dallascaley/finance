$(document).ready(function() {
	$('#signup-form').validate({
		rules: {
			username: "required"
		}
	});

	$('#signup-form').on('submit', function(e) {
		e.preventDefault();
		
		console.log('validate this');
	});
});