/*
if(typeof(API) == "undefined")
	alert("Please config your API url");
*/
$(document).ready(function(){
	$('#register-form').submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		$('#register-form .status').removeClass('fail').text('');
		$('#register-form input').attr("disabled", true);
		
		$.post(API + '/user/create', data, function(response){
			if(response.status == 'fail'){
				$('.status').addClass('fail').text(response.message);
				$('#register-form input').attr("disabled", false);
			}else{
				$('.status').text('Signup success.');
				window.location = DOMAIN + '/login';
			}
			
		}).fail(function(err){
			$('.status').addClass('fail').text(err);
			$('#register-form input').attr("disabled", false);
		})
	});

	$('#login-form').submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		$('#register-form .status').removeClass('fail').text('');
		$('#register-form input').attr("disabled", true);
		
		$.post(DOMAIN + '/login', data, function(response){
			if(response.status == 'fail'){
				$('.status').addClass('fail').text(response.message);
				$('#register-form input').attr("disabled", false);
			}else{
				$('.status').text('Login success.');
				window.location = DOMAIN + '/dashboard';
			}
			
		}).fail(function(err){
			$('.status').addClass('fail').text(err);
			$('#register-form input').attr("disabled", false);
		})
	});
})

//(function($, document, window){
	
	$(document).ready(function(){
		$(".slider").flexslider({
			controlNav: true,
			directionNav: false
		});
		$(".menu-toggle").click(function(){
			$(".mobile-navigation").slideToggle();
		});
		$(".mobile-navigation").append($(".main-navigation .menu").clone());

		$(".more-student").height( $(".more-student").innerWidth() );

		$(".accordion-toggle").click(function(){
			var current = $(this).parent();
			if( !current.hasClass("expanded") ){
				current.siblings(".accordion").removeClass("expanded").find(".accordion-content").slideUp();
				current.addClass("expanded").find(".accordion-content").slideDown();
			} else {
				current.removeClass("expanded");
				current.find(".accordion-content").slideUp();
			}
		});

		if( $(".map").length ){
			$('.map').gmap3({
				map: {
					options: {
						maxZoom: 14,
						scrollwheel: false
					}  
				},
				marker:{
					address: "40 Sibley St, Detroit",
				}
			},
			"autofit" );
	    }
	});

	$(window).resize(function(){
		$(".more-student").height( $(".more-student").innerWidth() );
	});


//})(jQuery, document, window);