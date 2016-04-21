$(document).ready(function()
{
	var screenHeight = $(window).height();
	var heightForm = 0;

	var time = 800;

	$('.popular .item:nth-child(3n+4)').css({'margin-right':'0px'});

	$('.popular .item .name').css({'opacity':'0.99'});
	$('.manufacturers .item .name').css({'opacity':'0.99'});
	$('.popular .item .more').css({'opacity':'0.99'});
	$('.manufacturers .item .more').css({'opacity':'0.99'});
	$('.popup').css({'opacity':'0'});
	$('.popup form').css({'opacity':'0.99'});
	$('.popup .overlay').css({'opacity':'0.7'});


	$(".slider").tinycarousel({
		bullets  : true
	});


	function setPopup(){
		$(".popup form").css({
			'margin-top': (screenHeight - heightForm)/2,
			'margin-left': (document.documentElement.clientWidth - $(".popup form").width())/2,
			});

		$('.overlay').click(function(){
			$('.popup').fadeOut(time);
			setTimeout(function(){
				$('.popup form.enter').css({'display':'block'});
				$('.popup form.reg').css({'display':'block'});
			},time);
		});
	}

	$(document).resize(function(){
		setPopup();
	});

	$('.overlay').click(function(){
		$('.popup').fadeOut(time);
	});


	$('.selection .checkbox').click(function(){
		if($(this).next('ul.checkboxList').css('display') == 'block'){
			$(this).next('ul.checkboxList').css({'display':'none'});
			$(this).css({'background-color':'#f4f7f8'});
		} else {
			$(this).next('ul.checkboxList').css({'display':'block'});
			$(this).css({'background-color':'#ffffff'});
		}
	});

	$('.selection .checkbox.main input').change(function(){
		if($(this).prop("checked") == true){
			$(this).parents('.checkbox').next('ul.checkboxList').css({'display':'block'});
			$(this).parents('.checkbox').css({'background-color':'#ffffff'});

			$(this).parents('.checkbox').next().attr({'id':'active'});
			$('ul#active input').prop("checked", true);
			$('ul#active').removeAttr('id');
		}
	});

	$('.selection ul.checkboxList input').change(function(){
		$(this).parents('ul.checkboxList').attr({'id':'activeList'});
		$(this).parents('ul.checkboxList').prev().attr({'id':'active'});

		if($(this).prop("checked") == false){
			$('#active.checkbox input').prop("checked", false);
		}else{
			flag = 0;
			for(var i=0; i<$('#activeList input').length;i++){
				if ($('#activeList input').eq(i).prop("checked") == true) {flag=1;} 
				else {flag=0; break;}
			};

			if(flag == 1){
				$('#active.checkbox input').prop("checked", true);
			}

		};
		$('#activeList.checkboxList').removeAttr('id');
		$('#active.checkbox').removeAttr('id');
	});

	//Авторизация
	$('.buttons .enter').click(function(){
		$('.popup').fadeTo(time,1);
		heightForm = $(".popup form.enter").height();
		$('.popup form.reg').css({'display':'none'});
		setPopup();
	});

	//Регистрация
	$('.buttons .registration').click(function(){
		$('.popup').fadeTo(time,1);
		heightForm = $(".popup form.reg").height();
		$('.popup form.enter').css({'display':'none'});
		setPopup();

		$('.selectRang div').click(function(){
			 $('.selectRang div.active').removeAttr('class');
			 $(this).attr({'class':'active'});
			 $('.selectRang input').val($(this).text());
		});
	});

	var heightMenu = $('ul.products').height();
	$('.products .content.block').css({'height':heightMenu});

	//Анимация меню
	$('ul.products li.nav a').click(function(){
		$('ul.submenu').animate({'margin-left':'0px'},time);
		$('ul.products').animate({'height':'0px'},time);

		$('.slider').fadeOut(time/2);
		setTimeout(function(){$('.table').fadeTo(time/2,1);},time/2);
	});

	$('ul.submenu li.back').click(function(){
		$('ul.submenu').animate({'margin-left' : '-185px'},time);
		$('ul.products').animate({'height' : heightMenu},time);

		$('.table').fadeOut(time/2);
		setTimeout(function(){$('.slider').fadeTo(time/2,1);},time/2);
	});

	//Подсветка колонок и столбцов таблицы
	$("table td").on("mouseenter mouseleave", function(){
	    if ($(this).parents("table tr").attr("class")!="up_row") {
	        var td_index=$(this).index();
	        $(this).parents("tr").toggleClass("current_col");
	        $(this).parents("table").find("tr:not(.up_row)").each(function(){
	            $("td:eq("+td_index + ")",this).toggleClass("current_col");
	        });
	        $(this).toggleClass("current_cell");
	    }
	});
});