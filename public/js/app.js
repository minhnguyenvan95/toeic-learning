//var API = "http://localhost:8000/api/v1/";
if(typeof(API) == "undefined")
	alert("Please config your API url");

jQuery(document).ready(function(){
	$('#register-form').submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		
		$.post(API + '/user/create', data, function(response){
			
		}).fail(function(err){
			alert('err');
			//Show modal
		})
	});

	$('#login-form').submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		
		$.post(API + '/user/get_token', data, function(response){
			
		}).fail(function(err){
			alert('err');
			//Show modal
		})
	});
	
})