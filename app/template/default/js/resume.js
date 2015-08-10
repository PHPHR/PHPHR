//下载简历 
$(document).ready(function(){ 
	$("input[name='background_type']").click(function(){
		if($(this).val()=='1'){
			$(".resume_background_color").hide();
			$(".resume_background_image").show();
		}else if($(this).val()=='2'){
			$(".resume_background_image").hide();
			$(".resume_background_color").show();
		}else{
			$(".resume_background_color").show();
			$(".resume_background_image").show();
		}
	});
})
//简历详情页查看联系方式、下载简历
function for_link(eid,url){
	var i=layer.load('执行中，请稍候...',0);
	$.post(url,{eid:eid},function(data){
		layer.close(i);
		var data=eval('('+data+')');
		var status=data.status;
		if(status==1){
			layer.msg(data.msg, 2,8);
		}else if(status==2){
			if(data.usertype=='2'){
				layer.confirm(data.msg, function(){down_integral(eid,data.uid,downurl);});
			}else{
				layer.confirm(data.msg, function(){lt_down_integral(eid,data.uid,downurl);});
			} 
		}else if(status==3){
			$("#for_link .city_1").html(data.html);
			$.layer({
				type : 1,
				title : "查看联系方式", 
				offset: [($(window).height() - 150)/2 + 'px', ''],
				closeBtn : [0 , true],
				border : [10 , 0.3 , '#000', true],
				area : ['350px','auto'],
				page : {dom :"#for_link"}
			});
		}else if(status==4){
			layer.confirm(data.msg, function(){showpacklist();});
		} 
	});
}
function check_comvip(price){
	$(".Download_resume_tips_f").html("￥"+price);
	$(".Download_resume_tips_jine").show();
}
//下载简历积分模式
function down_integral(eid,uid,url){
	$.post(url,{type:"integral",eid:eid,uid:uid},function(data){ 
		var data=eval('('+data+')');
		var status=data.status;
		var integral=data.integral;
		if(status==5){
			layer.confirm('您还有'+integral+integral_pricename+'！不够下载简历，是否充值？', function(){window.location.href =weburl+"/member/index.php?c=pay";window.event.returnValue = false;return false; }); 
		}else if(status==3 || status==6){
			$.layer({
				type : 1,
				title : "查看联系方式", 
				offset: [($(window).height() - 150)/2 + 'px', ''],
				closeBtn : [0 , true],
				border : [10 , 0.3 , '#000', true],
				area : ['350px','auto'],
				page : {dom :"#for_link"}
			});
		}else{
			layer.msg(data.msg, 2, 8);return false;
		}
	})
} 
function settemplate(tmpid,url){
	var eid=$("#eid").val();
	$.post(url,{eid:eid,tmpid:tmpid},function(data){
		var data=eval('('+data+')');
		if(data.url==''){
			layer.msg(data.msg,2,data.status);return false;
		}else{
			layer.msg(data.msg,2,data.status,function(){location.href=data.url;});return false;
		}
	});
}
function add_user_talent(uid,usertype){
	if(usertype=="2"){
		$.layer({
			type : 1,
			title : "添加备注", 
			closeBtn : [0 , true],
			border : [10 , 0.3 , '#000', true],
			area : ['380px','200px'],
			page : {dom :"#talent_pool_beizhu"}
		});
	}else if(usertype==""){
		showlogin('2');
	}else{
		layer.msg('只有企业用户，才可以操作！',2,8);return false;
	}
}
function talent_pool(uid,eid,url){
	var remark=$("#remark").val();
	$.post(url,{eid:eid,uid:uid,remark:remark},function(data){
		if(data=='0'){
			layer.msg('只有企业用户，才可以操作！',2,8);
		}else if(data=='1'){
			layer.msg('加入成功！',2,9,function(){layer.closeAll();});
		}else if(data=='2'){
			layer.msg('该简历已加入到人才库！',2,8,function(){layer.closeAll();});
		}else{
			layer.msg('对不起，操作出错！',2,8);
		}
	});
}