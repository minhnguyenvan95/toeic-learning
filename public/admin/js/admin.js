$(document).ready(function(){
	$('#admin-form').submit(function(e){
		e.preventDefault();
		$('#admin-form .ajax-loader').fadeIn();
		var data = $(this).serialize();
		$('#register-form .status').removeClass('fail').text('');
		$('#register-form input').attr("disabled", true);
		
		$.post(DOMAIN + '/login', data, function(response){
			$('#admin-form .ajax-loader').fadeOut();
			if(response.status == 'fail'){
				$('.status').addClass('fail').text(response.message);
				$('#register-form input').attr("disabled", false);
			}else{
				$('.status').text('Login success.');
				console.log(response.message);
				window.location = DOMAIN + '/acp/dashboard';
			}
			
		}).fail(function(err){
			$('#admin-form .ajax-loader').fadeOut();
			$('.status').addClass('fail').text(err);
			$('#register-form input').attr("disabled", false);
		})
	});
});