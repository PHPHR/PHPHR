$(function(){
	$search();
	$sift();
	$(".index .m_wrap1 .hd li").click(function(){
		$search();
		var i = $(".index .m_wrap1 .hd li").index(this);
		$(".index .m_wrap1 .hd li").removeClass("on");
		$(this).addClass("on");
		//$(".index .m_wrap1 .bd .none").hide();
		//$(".index .m_wrap1 .bd .none").eq(i).show();
	});
	                     
	$(".zrczgz .m_wrap1 dt a").click(function(){
		var i = $(".zrczgz .m_wrap1 dt a").index(this);
		 $(".zrczgz .m_wrap1 dt a").removeClass("hover");
		$(this).addClass("hover");
		$(".zrczgz .m_wrap1 dd .none").hide(); 
		$(".zrczgz .m_wrap1 dd .none").eq(i).show(); 
	});

	$(".zrczgz .m_nav dl").hover(function(){
		var i = $(".zrczgz .m_nav dl").index(this);
		$(this).removeClass("hover");
		$(this).addClass("hover");
		$(this).find("dd.popup").show();
	},function(){
		$(this).removeClass("hover");
		$(this).find("dd.popup").hide();
	});
	
	$('.jbxx .m_wrap1 dt').click(function(){
        if( $(this).parents('.m_wrap1').hasClass('on')){
            $(this).parents('.m_wrap1').removeClass('on');
        }else{
            $(this).parents('.m_wrap1').addClass('on');
        }
    });
	
	$(".m_download").click(function(){
		var x = ($(window).width()-$(".m_popup").width())/2
		var y = ($(window).height()-$(".m_popup").height())/2
		$(".m_popup").css({"left":x,"top":y});
		$(".m_body,.m_popup").fadeIn();	
	});
	$(".jbxx").find(".m_popup .close").click(function(){
		$(".m_body,.m_popup").fadeOut();	
	});
	/*banner自适应屏幕*/
	//var w_img = window.screen.width
	//$(".slideBox .bd").find("img").width(w_img);
	/*banner自适应屏幕*/
	/*回顶部*/
	/*$("#totop").click(function() {
        $('body,html').animate({
            scrollTop : 0
        }, 500);
        return false;
    }); */
	/*回顶部*/
	/*$(window).scroll(function () {
		if($(window).scrollTop()>500){
			$("#totop").show();
		}else{
			$("#totop").hide();
		}
	});*/
});


var $search = (function(){
	$(".searchSelected").click(function(){
		$(".searchTab").show();
		$(this).addClass("searchOpen");
	});

	$(".searchTab li").hover(function(){
		$(this).addClass("selected");
	},function(){
		$(this).removeClass("selected");
	});

	$(".searchTab li").click(function(){
		var v = $(this).html();
		var s = $(this).attr("i");
		$(".searchSelected").html(v);
		$(".searchMenu .hidden").attr("value",v);
		$(".searchMenu .hid").attr("value",s);
		$(".searchTab").hide();
		$(".searchSelected").removeClass("searchOpen");
	});
});



var $sift = (function(){
	var dlNum  =$("#selectList").find("dl");
	for (i = 0; i < dlNum.length; i++) {
		$(".hasBeenSelected .clearList").append("<div class=\"selectedInfor selectedShow\" style=\"display:none\"><span></span><label></label><em></em></div>");
	}
	
	var refresh = "true";
	
	$(".listIndex a ").live("click",function(){
		var text =$(this).text();
		var selectedShow = $(".selectedShow");
		var textTypeIndex =$(this).parents("dl").index();
		var textType =$(this).parent("dd").siblings("dt").text();
		index = textTypeIndex -(2);
		$(".clearDd").show();
		$(".selectedShow").eq(index).show();
		$(this).addClass("selected").siblings().removeClass("selected");
		//selectedShow.eq(index).find("span").text(textType);
		selectedShow.eq(index).find("label").text(text);
		var show = $(".selectedShow").length - $(".selectedShow:hidden").length;
		if (show > 1) {
			$(".eliminateCriteria").show();
		}
	   
	});
	$(".selectedShow em").live("click",function(){
		$(this).parents(".selectedShow").hide();
		var textTypeIndex =$(this).parents(".selectedShow").index();
		index = textTypeIndex;
		$(".listIndex").eq(index).find("a").removeClass("selected");
		
		if($(".listIndex .selected").length < 2){
			$(".eliminateCriteria").hide();
		}
	});
	
	$(".eliminateCriteria").live("click",function(){
		$(".selectedShow").hide();
		$(this).hide();
		$(".listIndex a ").removeClass("selected");
	}); 
	
	$(".selectNumberScreen").find("i.more").toggle(function(){
		$(this).parent().removeAttr("style");	
	},function(){
		$(this).parent().height(25);	
	});





});
/*setTimeout(function(){
alert(msg);
},1000);*/
//console.log()