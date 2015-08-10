$(document).ready(function () {	 
	$("div.cp_ti_canj").hover(function(){
		$(this).css("background-color","#f0f0f0");
	},function(){
		$(this).css("background-color","");
	});
	
	/*点击选项，更改class*/
	$("div.cp_ti_canj").click(function(){ 
		$(this).parent().children().attr("class","cp_ti_canj");/*同组选项的背景色恢复默认*/
		$(this).parent().children().children("input[type='radio']").removeAttr("checked");
		if($(this).children("input[type='radio']").attr("checked") == undefined ){
			$(this).children("input[type='radio']").attr("checked","checked")
			$(this).attr("class","cp_ti_canj cp_ti_canj01");
		}
	});  
	/*检测是否全部选择*/
	$("#submitexam").click(function(){
		var error=0;	
		$(".cp_timu_topic01>.cp_timu_topic").each(function(){
			var tid=$(this).attr("tid"); 
			var val=$("input:radio[name='q"+tid+"']:checked").val();
			if(isNaN(val)){ 
				error+=1;
				var top=parseInt($(".eva"+tid).offset().top)-parseInt(30); 
				layer.msg("必须全部答完才能交卷！",2,8,function(){$("html, body").animate({scrollTop:top});return false;});return false;
			} 
		});
		if(error=='0'){
			setTimeout(function(){$('#gradeform').submit()},0);
		}
	}); 
	window.topBigDiv = $("div.cp_text_top");
	var topBottonLi = $("#top_small").children("ul").children("li");
	window.targetIndex = 0;
	window.timer;
	window.intervalMS = 3000; 
	$("#cp_top_div,#top_small").mouseover(function(){
		clearInterval(timer);
	});
	$("#cp_top_div,#top_small").mouseout(function(){
		timer = setInterval("huandeng()", intervalMS);
	});
	timer = setInterval("huandeng()", intervalMS);

	/*鼠标移动选择大图片*/
	topBottonLi.mouseover(function () {
		targetIndex = $(this).index();
		topBigDiv.each(function (index, domEle) {
			if (Number(targetIndex) == Number(index)) {
				$(domEle).show();
			} else {
				$(domEle).hide();
			}
		});
	});
});
function huandeng() {
	topBigDiv.each(function (index, domEle) {
		if (Number(targetIndex % 4) == Number(index)) {
			$(domEle).show();
		} else {
			$(domEle).hide();
		}
	});
	targetIndex++;
} 