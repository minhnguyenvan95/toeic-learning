/*
if(typeof(API) == "undefined")
	alert("Please config your API url");
*/
var isPackage = false;
var questions_packages = [];
var questions_arr = [];
var answered = [];
var timercounter;

function addTimer(){
	var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    var totalSeconds = 0;
    timercounter = setInterval(setTime, 1000);

    function setTime()
    {
        ++totalSeconds;
        secondsLabel.innerHTML = pad(totalSeconds%60);
        minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
    }

    function pad(val)
    {
        var valString = val + "";
        if(valString.length < 2)
        {
            return "0" + valString;
        }
        else
        {
            return valString;
        }
    }
}

function build_nav_questions_packages(){
	var html = '';
	html += '<label id="minutes">00</label>:<label id="seconds">00</label>';
	html += '<div class="wpProQuiz_reviewDiv">';
	html += '<div class="wpProQuiz_reviewQuestion" style="overflow-y:auto;max-height:150px!important">';
	html += '<ol id="question_nav_list" style="margin-top: 0px !important">';
	var k=1;
	for(i=0;i<questions_packages.length;i++){
		for(j=0;j<questions_packages[i].questions.length;j++){
			questions_packages[i].questions[j].question_number = k;
			var q = questions_packages[i].questions[j];
			var a = q.answers;
			var answer_id = -1;
			for(l=0;l<a.length;l++){
				if(a[l].checked = 1){
					answer_id = a[l].id;
					break;
				}
			}

			html += '<li data-package="' + i + '" data-question_id="' + q.id + '" data-answer_id="'+answer_id+'">' + k + '</li>';
			k++;			
		}
	}
	html += '</ol></div>';
	html += '<div class="wpProQuiz_reviewLegend"> <ol> <li> <span class="wpProQuiz_reviewColor" style="background-color: #6CA54C;"></span> <span class="wpProQuiz_reviewText">Answered</span> </li> <li> <span class="wpProQuiz_reviewColor" style="background-color: #e91e63;"></span> <span class="wpProQuiz_reviewText">Wrong</span> </li></ol> <div style="clear: both;"></div> </div>';
	$('#question-nav').html(html);
	build_questions_packages();
	show_questions_packges(0,"."+questions_packages[0].questions[0].id);

	$('#question_nav_list li').click(function(){
		var data = $(this).data();
		show_questions_packges(data.package,'.'+data.question_id);
	});
	addTimer();
}

function build_questions_packages(){
	var html = '';

	for(k=0;k<questions_packages.length;k++){
		var pkg = questions_packages[k];
		html += '<div class="package-container" id="' + k + '" style="display:none">';
		html += '<div class="package_content">' + pkg.content + '</div>';
		
		for(i=0;i<pkg.questions.length;i++){
			var q = pkg.questions[i];
			html += '<div class="wpProQuiz_question_text '+q.id+'"><b>' + q.question_number +'. ' + q.content + '</b></div>';
			html += '<ul class="wpProQuiz_questionList">';
			for(j=0;j<q.answers.length;j++){
				var a = q.answers[j];
				html += '<li class="wpProQuiz_questionListItem">'
					+ '<label data-answer_id="'+a.id+'"><input data-pkg="' + i + '" name="'+ q.id +'" class="answer wpProQuiz_questionInput" value="' + a.id + '" type="radio"/>'
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
		var pkg = $(this).data('pkg');
		var question_id = $(this).attr('name');
		var answer = $(this).attr('value');

		var data = {question_id : question_id, answer_id: answer};
		var flag = false;

		//Add too answered array
		for(i=0;i<answered.length;i++){
			if(answered[i].question_id == question_id){
				answered[i] = data;
				flag = true;
				break;
			}
		}
		if(flag == false)
			answered.push(data);

		$('#question_nav_list li').removeClass('selected');
		$('#question_nav_list li[data-question_id='+question_id+']').addClass('answered selected');

		if($('.show input.answer:checked').length >= $('.show .wpProQuiz_question_text').length){
			var pkg_id = $('.show.package-container').attr('id');
			var next_pkg = parseInt(pkg_id) + 1;
			if(next_pkg < questions_packages.length){
				var package_answers = $('#question_nav_list li[data-package='+next_pkg+']');
				for(i=0;i<package_answers.length;i++){
					if($(package_answers[i]).hasClass('answered') == false){
						show_questions_packges(next_pkg,'.'+questions_packages[next_pkg].questions[0].id);
						return;
					}
				}
			}

			var question_nav = $('#question_nav_list li');
			for(i=0;i<question_nav.length;i++){
				var q = question_nav[i];
				if($(q).hasClass('answered') == false){
					show_questions_packges($(q).data('package'), '.'+$(q).data('question_id'));
					return;
				}
			}
			//No more question 
			tinhdiem_packages();
		}
	})
}

function tinhdiem_packages(){
	clearInterval(timercounter);
	$('#question_nav_list li').removeClass('selected');

	for(i=0;i<answered.length;i++){
		var answer = answered[i];
		var right_answer = $('#question_nav_list li[data-question_id='+answer.question_id+']').data();
		if(answer.answer_id != right_answer.answer_id){
			$('#question_nav_list li[data-question_id='+answer.question_id+']').addClass('wrong');
			$('#question-wrapper li label[data-answer_id='+ right_answer.answer_id+']').addClass('wrong');
		}
	}
}

function show_questions_packges(id,scrollId){
	$('.package-container, .question-container').removeClass('show').hide();
	$('#'+id).addClass('show').fadeIn();
	var current_audio = $('#'+id+' audio');
	if(current_audio.length > 0){
		current_audio.addClass('playid_'+id);
	
		var list_audios = $('audio');
		for(i=0;i<list_audios.length;i++){
			var a = list_audios[i];
			var flag = $(a).hasClass('playid_'+id);

			if(a.paused == false && flag == false){
				a.pause();
				a.currentTime = 0;
			}
			else if(flag == true){

			}
		}

		if(a.paused == true){
			current_audio[0].load();
			current_audio[0].play();
		}
	}
	$('#question_nav_list li').removeClass('selected');
	if(scrollId != null){
		var question_id = scrollId.replace('.','').replace('#','');
		$('#question_nav_list li[data-question_id='+question_id+']').addClass("selected");
		
		if(isPackage)
			$('html, body').animate({scrollTop: $(scrollId).offset().top - 30}, 800);
	}
}

function build_nav_questions(){
	var html = '';
	html += '<label id="minutes">00</label>:<label id="seconds">00</label>';
	html += '<div class="wpProQuiz_reviewDiv">';
	html += '<div class="wpProQuiz_reviewQuestion" style="overflow-y:auto;max-height:150px!important">';
	html += '<ol id="question_nav_list" style="margin-top: 0px !important">';
	
	for(j=0;j<questions_arr.length;j++){
		var q = questions_arr[j];
		var a = q.answers;
		var answer_id = -1;
		for(l=0;l<a.length;l++){
			if(a[l].checked = 1){
				answer_id = a[l].id;
				break;
			}
		}
		html += '<li data-package="' + j + '" data-question_id="' + q.id + '" data-answer_id="'+answer_id+'">' + (j+1) + '</li>';
	}
	
	html += '</ol></div>';
	html += '<div class="wpProQuiz_reviewLegend"> <ol> <li> <span class="wpProQuiz_reviewColor" style="background-color: #6CA54C;"></span> <span class="wpProQuiz_reviewText">Answered</span> </li> <li> <span class="wpProQuiz_reviewColor" style="background-color: #e91e63;"></span> <span class="wpProQuiz_reviewText">Wrong</span> </li></ol> <div style="clear: both;"></div> </div>';
	$('#question-nav').html(html);
	build_questions_arr();
	show_questions_packges(0,"."+questions_arr[0].id);

	$('#question_nav_list li').click(function(){
		var data = $(this).data();
		show_questions_packges(data.package,'.'+data.question_id);
	});
	addTimer();
}

function build_questions_arr(){
	var html = '';
	
	for(i=0;i<questions_arr.length;i++){
		var q = questions_arr[i];
		html += '<div class="question-container" id="' + i + '" style="display:none">';
		html += '<div class="wpProQuiz_question_text '+q.id+'"><b>' + (i+1) +'. ' + q.content + '</b></div>';
		html += '<ul class="wpProQuiz_questionList">';
		for(j=0;j<q.answers.length;j++){
			var a = q.answers[j];
			html += '<li class="wpProQuiz_questionListItem">'
				+ '<label data-answer_id="'+a.id+'"><input data-pkg="' + i + '" name="'+ q.id +'" class="answer wpProQuiz_questionInput" value="' + a.id + '" type="radio"/>'
				+ a.content
				+ '.</label>'
				+ '</li>';
			
		}
		html += '</ul>';
		html += '</div>';
	}

	$("#question-wrapper").html(html);
	$('input.answer').click(function(){
		var pkg = $(this).data('pkg');
		var question_id = $(this).attr('name');
		var answer = $(this).attr('value');

		var data = {question_id : question_id, answer_id: answer};
		var flag = false;

		//Add too answered array
		for(i=0;i<answered.length;i++){
			if(answered[i].question_id == question_id){
				answered[i] = data;
				flag = true;
				break;
			}
		}
		if(flag == false)
			answered.push(data);

		$('#question_nav_list li').removeClass('selected');
		$('#question_nav_list li[data-question_id='+question_id+']').addClass('answered selected');

		if($('.show input.answer:checked').length >= $('.show .wpProQuiz_question_text').length){
			var pkg_id = $('.show.package-container').attr('id');
			var next_pkg = parseInt(pkg_id) + 1;
			if(next_pkg < questions_arr.length){
				var package_answers = $('#question_nav_list li[data-package='+next_pkg+']');
				for(i=0;i<package_answers.length;i++){
					if($(package_answers[i]).hasClass('answered') == false){
						show_questions_packges(next_pkg,'.'+questions_arr[0].id);
						return;
					}
				}
			}

			var question_nav = $('#question_nav_list li');
			for(i=0;i<question_nav.length;i++){
				var q = question_nav[i];
				if($(q).hasClass('answered') == false){
					show_questions_packges($(q).data('package'), '.'+$(q).data('question_id'));
					return;
				}
			}
			//No more question 
			tinhdiem_packages();
		}
	})
}

$(document).ready(function(){
	if($("#question-wrapper").length){
		var type = $("#question-wrapper").data('type');
		$.get(API + '/practice/'+type,function(data){
			if(data.status == 'success' && data.message.length > 0){
				isPackage = data.isPackage;
				if(isPackage){
					questions_packages = data.message;
					build_nav_questions_packages();
					//show_question_packges();
				}else{
					questions_arr = data.message;
					build_nav_questions();
				}
			}

			if(data.message.length == 0){
				alert("We don't have any question for this type")
			}
		});
	}

	$('#register-form').submit(function(e){
		e.preventDefault();
		$('#register-form .ajax-loader').fadeIn();
		var data = $(this).serialize();
		$('#register-form .status').removeClass('fail').text('');
		$('#register-form input').attr("disabled", true);
		
		$.post(API + '/user/create', data, function(response){
			$('#register-form .ajax-loader').fadeOut();
			if(response.status == 'fail'){
				$('.status').addClass('fail').text(response.message);
				$('#register-form input').attr("disabled", false);
			}else{
				$('.status').text('Signup success.');
				window.location = DOMAIN + '/login';
			}
			
		}).fail(function(err){
			$('#register-form .ajax-loader').fadeOut();
			$('.status').addClass('fail').text(err);
			$('#register-form input').attr("disabled", false);
		})
	});

	$('#dashboard-form').submit(function(e){
		e.preventDefault();
		$('#dashboard-form .ajax-loader').fadeIn();
		var data = $(this).serialize();
		$('#dashboard-form .status').removeClass('fail').text('');
		$('#dashboard-form input').attr("disabled", true);
		
		$.post(API + '/user/update', data, function(response){
			$('#dashboard-form .ajax-loader').fadeOut();
			$('.status').text(response.message);
			$('#dashboard-form input').attr("disabled", false);
			
		}).fail(function(err){
			$('#dashboard-form .ajax-loader').fadeOut();
			$('.status').addClass('fail').text(err);
			$('#dashboard-form input').attr("disabled", false);
		})
	});

	$('#login-form').submit(function(e){
		e.preventDefault();
		$('#login-form .ajax-loader').fadeIn();
		var data = $(this).serialize();
		$('#login-form .status').removeClass('fail').text('');
		$('#login-form input').attr("disabled", true);
		
		$.post(DOMAIN + '/login', data, function(response){
			$('#login-form .ajax-loader').fadeOut();
			if(response.status == 'fail'){
				$('.status').addClass('fail').text(response.message);
				$('#login-form input').attr("disabled", false);
			}else{
				$('.status').text('Login success.');
				window.location = DOMAIN + '/dashboard';
			}
			
		}).fail(function(err){
			$('#login-form .ajax-loader').fadeOut();
			$('.status').addClass('fail').text(err);
			$('#login-form input').attr("disabled", false);
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