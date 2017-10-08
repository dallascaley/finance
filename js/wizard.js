$(document).ready(function() {

	$('.go_to_step').on('click', function(e) {
		var segments = $(this).attr('id').split('-');
		$('#intro').hide();
		$('.wizard').hide();

		$('.wizard.' + segments[1]).show();
	});


});