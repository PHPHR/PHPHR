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

$(function(){
	$(".select").each(function(){
		var s=$(this);
		var z=parseInt(s.css("z-index"));
		var dt=$(this).children("dt");
		var dd=$(this).children("dd");
		var _show=function(){dd.slideDown(200);dt.addClass("cur");s.css("z-index",z+1);};  
		var _hide=function(){dd.slideUp(200);dt.removeClass("cur");s.css("z-index",z);};   
		dt.click(function(){dd.is(":hidden")?_show():_hide();});
		dd.find("a").click(function(){dt.html($(this).html());_hide();}); 
		$("body").click(function(i){ !$(i.target).parents(".select").first().is(s) ? _hide():"";});
	})
})











