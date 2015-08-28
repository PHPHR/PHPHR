$(function(){
	$(".rdh").hover(function() {
		$(this).children(".zypop").show();
		$(this).children(".zypop").stop().animate({
			left: "-104px",
			opacity: "1"
		}, 400)
	}, function() {
		$(this).children(".zypop").hide();
		$(this).children(".zypop").stop().animate({
			left: "-124px",
			opacity: "0"
		}, 1)
	});
	$(".rdh2").hover(function() {
		$(this).children(".ewm").show();
		$(this).children(".ewm").stop().animate({
			left: "-92px",
			opacity: "1"
		}, 400)
	}, function() {
		$(this).children(".ewm").hide();
		$(this).children(".ewm").stop().animate({
			left: "-150px",
			opacity: "0"
		}, 1)
	});
})

$(document).ready(function(e) {
	$("#backToTop").live("click", function(){
		var _this = $(this);
		$('html,body').animate({ scrollTop: 0 }, 500 ,function(){
		});
	});
});
//
//$(function(){
//	$(".select").each(function(){
//		var s=$(this);
//		var z=parseInt(s.css("z-index"));
//		var dt=$(this).children("dt");
//		var dd=$(this).children("dd");
//		var _show=function(){dd.slideDown(200);dt.addClass("cur");s.css("z-index",z+1);};
//		var _hide=function(){dd.slideUp(200);dt.removeClass("cur");s.css("z-index",z);};
//		dt.click(function(){dd.is(":hidden")?_show():_hide();});
//		dd.find("a").click(function(){dt.html($(this).html());_hide();});
//		$("body").click(function(i){ !$(i.target).parents(".select").first().is(s) ? _hide():"";});
//	})
//})


$(window).load(function(){

    //
    //$(window).scroll(function(){
    //    var x=$(this).scrollTop();
    //    if(x>110){
    //        $('.right_all').css({'position':'fixed','right':'50%','margin-right':'-500px','top':'10px'});
    //    }else if(x<120){
    //        $('.right_all').css({'position':'static','margin-right':'0px'});
    //    }
    //});
    //

    $('.select dt').click(function(){
        if( $(this).parents('.select').hasClass('on')){
            $(this).parents('.select').removeClass('on');
        }else{
            $(this).parents('.select').addClass('on');
        }
    });
    $('.select dd li').click(function(){

        $(this).parents('.select').removeClass('on');
        var x =$(this).html();
        var y =$(this).attr('myselect');
        $(this).parents('dd').siblings('dt').html(x);
        $(this).parents('ul').siblings('.select_hidden').attr('value',y);
        console.log(y);
    });

    $('.day li').click(function(){
        $(this).siblings('li').removeClass('hover').find('.checkbox_hidden').attr('checked',false);
        $(this).addClass('hover').find('.checkbox_hidden').attr('checked',true);

    });


    $('#tab_hd li').click(function(){
        $(this).addClass('on').siblings('li').removeClass('on');
        var x =$(this).index();
        $('#tab_bd').children('.li').eq(x).show().siblings('.li').hide();
    });

    $('.t_pic .button').click(function(){
        $(this).parents('.t_pic').hide();
    });



    $('.colsebut').click(function(){
        $(this).parents('.inputbox').hide().siblings('.infobox').show();
    });



    $('.open_but').click(function(){
        $(this).parents('.p1').siblings('.box1').find('.zb').find('.inputbox').show().siblings('.infobox').hide();
    });




    $('.model_box .close').click(function(){
        $(this).parents('.model_box').removeClass('on');
    });

    $('.myopenbut').click(function(){
        $(this).siblings('.model_box').addClass('on');
    });

    $('.model_box ul li span').click(function(){
        var x =$(this).html();
        var y =$(this).attr('myselect');

        $(this).parents('.model_box').siblings('.myopenbut').html(x);
        $(this).parents('ul').siblings('.model_input').attr('value',y);
        $(this).parents('.model_box').removeClass('on');
    });

    $('.zy_js li').click(function(){
        $(this).addClass('on').siblings('li').removeClass('on').find('.zy_input').attr('checked',false);
        $(this).find('.zy_input').attr('checked',true);
    });

    $('.collect').click(function(){
        if($(this).hasClass('on')){
            $(this).removeClass('on');
            $(this).find('em').html('收藏');
            $(this).find('input').attr('checked',false);
        }else{
            $(this).addClass('on');
            $(this).find('em').html('已收藏');
            $(this).find('input').attr('checked',true);
        }
    });

});










