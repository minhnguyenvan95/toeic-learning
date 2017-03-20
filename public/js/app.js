/*
if(typeof(API) == "undefined")
	alert("Please config your API url");
*/
var isPackage = false;
var questions_packages = [];
var questions_arr = [];
var answers = [];

function build_nav_questions_packages(){
	var html = '';
	html += '<div class="wpProQuiz_reviewDiv">';
	html += '<div class="wpProQuiz_reviewQuestion" style="overflow-y:auto;max-height:150px!important">';
	html += '<ol style="margin-top: 0px !important">';
	var k=1;
	for(i=0;i<questions_packages.length;i++){
		for(j=0;j<questions_packages[i].questions.length;j++){
			questions_packages[i].questions[j].question_number = k;
			var q = questions_packages[i].questions[j];
			html += '<li data-package="' + i + '"" data-question_id="' + q.id + '">' + k + '</li>';
			k++;
		}
	}
	html += '</ol></div>';
	html += '<div class="wpProQuiz_reviewLegend"> <ol> <li> <span class="wpProQuiz_reviewColor" style="background-color: #6CA54C;"></span> <span class="wpProQuiz_reviewText">Answered</span> </li> </ol> <div style="clear: both;"></div> </div>';
	$('#question-nav').html(html);
	build_questions_packages();
	show_questions_packges(0);

	$('#question-nav li').click(function(){
		var data = $(this).data();
		show_questions_packges(data.package,'.'+data.question_id);
	});
}

function build_questions_packages(){
	var html = '';

	for(k=0;k<questions_packages.length;k++){
		var pkg = questions_packages[k];
		html += '<div class="package_wrapper" id="' + k + '" style="display:none">';
		html += '<div class="package_content">' + pkg.content + '</div>';
		
		for(i=0;i<pkg.questions.length;i++){
			var q = pkg.questions[i];
			html += '<div class="wpProQuiz_question_text '+q.id+'"><b>' + q.question_number +'. ' + q.content + '</b></div>';
			html += '<ul class="wpProQuiz_questionList">';
			for(j=0;j<q.answers.length;j++){
				var a = q.answers[j];
				html += '<li class="wpProQuiz_questionListItem">'
					+ '<label><input name="'+ q.id +'" class="answer wpProQuiz_questionInput" value="' + a.id + '" type="radio"/>'
					+ a.content
					+ '.</label>'
					+ '</li>';
				
			}
			html += '</ul>';
		}
		html += '</div>';
	}

	$("#question-wrapper").html(html);
	$('input.answer').click(function(){
		var question_id = $(this).attr('name');
		$('#question-nav li[data-question_id='+question_id+']').css('background-color','#6CA54C');

		if($('.show input.answer:checked').length >= $('.show .wpProQuiz_question_text').length){
			var pkg_id = $('.show.package_wrapper').attr('id');
			var next_pkg = parseInt(pkg_id) + 1;
			//if(next_pkg < questions_packages.length - 1)
			show_questions_packges(next_pkg,'#'+next_pkg);
		}
	})
}

function show_questions_packges(id,scrollId){
	$('.package_wrapper').removeClass('show').hide();
	$('#'+id).addClass('show').fadeIn();
	if(scrollId != null){
		$('html, body').animate({scrollTop: $(scrollId).offset().top - 30}, 800);
	}
}


$(document).ready(function(){
	if($("#question-wrapper").length){
		var type = $("#question-wrapper").data('type');
		$.get(API + '/practice/'+type,function(data){
			if(data.status == 'success'){
				isPackage = data.isPackage;
				if(isPackage){
					questions_packages = data.message;
					build_nav_questions_packages();
					//show_question_packges();
				}else{
					questions_arr = data.message;
				}
			}
		});
	}

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