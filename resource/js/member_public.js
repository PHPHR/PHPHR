var timestamp=Math.round(new Date().getTime()/1000) ;
function check_code(){
	document.getElementById("vcode_img").src="../app/include/authcode.inc.php?"+Math.random();
} 
function loadlayer(){
	layer.load('执行中，请稍候...',0);
}
function wait_result(){
	layer.closeAll();
	layer.load('执行中，请稍候...',0);
}
function showImgDelay(imgObj,imgSrc,maxErrorNum){  
    if(maxErrorNum>0){ 
        imgObj.onerror=function(){
            showImgDelay(imgObj,imgSrc,maxErrorNum-1);
        };
        setTimeout(function(){
            imgObj.src=imgSrc;
        },500);
		maxErrorNum=parseInt(maxErrorNum)-parseInt(1);
    }
}
function layer_del(msg,url){ 
	if(msg==''){
		var i=layer.load('执行中，请稍候...',0);
		$.get(url,function(data){
			layer.close(i);
			var data=eval('('+data+')');
			if(data.url=='1'){
				layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.reload();});return false;
			}else{
				layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.href=data.url;});return false;
			}
		});
	}else{
		layer.confirm(msg, function(){
			var i=layer.load('执行中，请稍候...',0);
			$.get(url,function(data){
				layer.close(i);
				var data=eval('('+data+')');
				if(data.url=='1'){
					layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.reload();});return false;
				}else{
					layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.href=data.url;});return false;
				}
			});
		});
	}
}
function addblack(){
	$.layer({
		type : 1,
		title : '搜索企业',
		closeBtn : [0 , true], 
		border : [10 , 0.3 , '#000', true],
		area : ['400px','320px'],
		page : {dom : '#blackdiv'}
	});
}
function quxiaoshenqin(id){
	$("#qsid").val(id);
	$.layer({
		type : 1,
		title : '取消原因',
		closeBtn : [0 , true], 
		border : [10 , 0.3 , '#000', true],
		area : ['300px','180px'],
		page : {dom : '#blackdiv'}
	});
}
function logout(url){
	$.get(url,function(msg){
		if(msg==1 || msg.indexOf('script')){
			if(msg.indexOf('script')){
				$('#uclogin').html(msg);
			}
			layer.msg('您已成功退出！', 2, 9,function(){window.location.href =weburl;});
		}else{
			layer.msg('退出失败！', 2, 8);
		}
	});
}
function searchcom(){
	var name=$.trim($("#name").val());
	if(name==''){
		layer.closeAll();
		layer.msg('请输入搜索的公司名称！', 2, 8,function(){addblack();});return false;
	}
	$.post("index.php?c=blacklist&act=searchcom",{name:name},function(data){
		$(".Blacklist_box>form>ul").html(data);		
	});
}
function ckaddblack(){
	var chk_value=[];
	$('input[name="buid[]"]:checked').each(function(){
		chk_value.push($(this).val());
	});
	layer.closeAll();
	if(chk_value.length==0){ 
		layer.msg("请选择要屏蔽的公司！",2,8,function(){addblack()});return false;
	} 
	layer.load('执行中，请稍候...',0);
}
function entrust(msg,id){
	wait_result();
	if(msg){
		layer.confirm(msg,function(){
			$.post("index.php?c=com_res&act=canceltrust",{id:id},function(data){
				var data=eval('('+data+')'); 
				if(data.url){
					layer.msg(data.msg, 2,Number(data.type),function(){window.location.href=data.url;});return false;	
				}else{
					layer.msg(data.msg, 2,Number(data.type),function(){location.reload();});return false;	
				} 		
			});
		});
	}else{
		$.post("index.php?c=com_res&act=canceltrust",{id:id},function(data){
			var data=eval('('+data+')'); 
			if(data.url){
				layer.msg(data.msg, 2,Number(data.type),function(){window.location.href=data.url;});return false;	
			}else{
				layer.msg(data.msg, 2,Number(data.type),function(){location.reload();});return false;	
			} 		
		});
	} 
} 
function addfriend(id,type){
	$.post(weburl+"/index.php?m=ajax&c=makefriends",{id:id,type:type},function(data){
		if(data=="5"){
			layer.alert('请先登录！', 0, '提示',function(){window.location.href ="index.php?m=login&usertype=1"; window.event.returnValue = false;return false;});
		}else if(data=="4"){
			layer.msg('不能添加自己为好友！', 2, 0);return false;  
		}else if(data=="3"){ 
			layer.msg('您未通过身份验证不能添加好友！', 2, 8);return false;  
		}else if(data=="2"){ 
			layer.msg('对方未通过身份审核，不能加其为好友！', 2, 8);return false;  
		}else if(data=="1"){ 
			layer.msg('已提交好友申请，等待对方同意！', 2, 1);return false; 
		}else if(data=="6"){ 
			layer.msg('你们已经好友！', 2, 9);return false; 
		}else if(data=="7"){ 
			layer.msg('已提交好友申请，请耐心等待！', 2, 1);return false;
		}
	});
} 
function buyad(){
	if($.trim($('#ad_name').val())==''){
		layer.msg('请输入广告名称！', 2, 2);return false;
	}
	if($.trim($('#pic_url').val())==''){
		layer.msg('请选择广告图片！', 2, 2);return false;
	}
	if($.trim($('#pic_src').val())==''){
		layer.msg('请输入广告链接！', 2, 2);return false;
	}
	if($.trim($('#buy_time').val())==''){
		layer.msg('请输入购买时间！', 2, 2);return false;
	}
	buy_vip_ad();
}
function buy_vip_ad(){ 
	var integral_buy=$("input[name=integral_buy]").val();
	var yh_integral=$("input[name=yh_integral]").val();   
	if(isNaN(yh_integral)==false){ 
		integral_buy=parseInt(integral_buy)-parseInt(yh_integral);
	}  
	var msg="购买此项服将扣除"+integral_buy+integral_pricename+"，是否继续？"; 
	layer.confirm(msg,function(){ 
		setTimeout(function(){$('#myform').submit()},0);
	});
}
$(document).ready(function(){
	$("#dingdan_submit").click(function(){
		var paytype=$("input[name=p1]:checked").val();
		var order=$("input[name=dingdan]").val();
		$.post(weburl+"/member/index.php?m=ajax&c=order_type",{order:order,paytype:paytype},function(data){return false;})
	})
	$("input[name=default_resume],.default_resume").click(function(){
		var value=$(this).val();
		if(value==''){value=$(this).attr('value');} 
		$.post(weburl+"/member/index.php?m=ajax&c=default_resume",{eid:value},function(data){
			if(data==0){
				layer.alert('请先登录！', 0, '提示',function(){window.location.href ="index.php?m=login&usertype=1";window.event.returnValue = false;return false;});
			}else if(data==1){ 
				layer.msg('设置成功！', 2, 9,function(){ location.reload();});return false; 
			}else{ 
				layer.msg('系统出错，请稍后再试！', 2, 8,function(){ location.reload();});return false; 
			}
		}) 
	}) 
	$(".seemsg").click(function(){
		var id=$(this).attr("id");
		$.post("index.php?c=up_msg",{id:id},function(msg){
			if(msg==1){
				$(".msgcontent").hide();
				$("#msg"+id).show();
			}else{
				layer.msg('非法操作！', 2, 0);return false; 
			}
		});
	})
	 
	$("#colse_box").click(function(){$('.job_box').hide();})
	$("#price_int").blur(function(){
		var value=$(this).val();
		var proportion=$(this).attr("int");
		var price=value/proportion;
		$("#com_vip_price").val(price);
		$("#span_com_vip_price").html(price);
	}) 
	$(".province").change(function(){
		var province=$(this).val();
		var lid=$(this).attr("lid");
		if(province==""){
			$("#"+lid+" option").remove()
			$("<option value='0'>请选择城市</option>").appendTo("#"+lid);
			lid2=$("#"+lid).attr("lid");
			if(lid2){
				$("#"+lid2+" option").remove();
				$("<option value='0'>请选择城市</option>").appendTo("#"+lid2);
				$("#"+lid2).hide();
			}
		}
		 
		$.post(weburl+"/index.php?m=ajax&c=ajax&"+timestamp, {"str":province},function(data) {  
			if(lid!="" && data!=""){
				$('#'+lid+' option').remove();
				$(data).appendTo("#"+lid);
				city_type(lid); 
			}
		})
	})
	$(".job1").change(function(){
		var province=$(this).val();
		var lid=$(this).attr("lid");
		$.post(weburl+"/index.php?m=ajax&c=ajax_job&"+timestamp, {"str":province},function(data) {
			if(lid!="" && data!=""){
				$('#'+lid+' option').remove();
				$(data).appendTo("#"+lid);
				job_type(lid);
			}
		})
	})
	$(".jobone").change(function(){
		var province=$(this).val();
		var lid=$(this).attr("lid");
		$.post(weburl+"/index.php?m=ajax&c=ajax_ltjob&"+timestamp, {"str":province},function(data) {
			if(lid!="" && data!=""){
				$('#'+lid+' option').remove();
				$(data).appendTo("#"+lid);
			}
		})
	})
	$("#details-ul li").click(function(){
		$("#details-ul li").attr("class","");
		$(this).attr("class","hover");
		$(".xinxi-guanli-box").hide();
		var name=$(this).attr("name");
		$("#details-con-"+name).show();
	})
})
 
function city_type(id){
	var id;
	var province=$("#"+id).val();
	var lid=$("#"+id).attr("lid");
	$.post(weburl+"/index.php?m=ajax&c=ajax&"+timestamp, {"str":province},function(data) {
		if(lid!=""){
			if(lid!="three_cityid" && lid!="three_city" && data!=""){
				$('#'+lid+' option').remove();
				$(data).appendTo("#"+lid);
			}else{
				if(data!=""){
					$('#'+lid+' option').remove();
					$(data).appendTo("#"+lid);
					$('#'+lid).show();
				}else{
					$('#'+lid+' option').remove();
					$("<option value='0'>请选择城市</option").appendTo("#"+lid);
					$('#'+lid).hide();
				}
			}
		}
	})
}
function job_type(id){
	var id;
	var province=$("#"+id).val();
	var lid=$("#"+id).attr("lid");
	$.post(weburl+"/index.php?m=ajax&c=ajax_job&"+timestamp, {"str":province},function(data) {
		if(lid!="" && data!=""){
			$('#'+lid+' option').remove();
			$(data).appendTo("#"+lid);
		}
	})
}
function check_form(ifidname,byidname){
	var ifidname;
	var byidname;
	if (ifidname){ 
		var msg=$("#"+byidname).html(); 
		layer.msg(msg, 2, 8);return false;
	}else{
		$("#"+byidname).hide(); 
		return true;
	}
}
function check_email(strEmail) {
	 var emailReg = /^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	 if (emailReg.test(strEmail))
	 return true;
	 else
	 return false;
 }
function isjsMobile(obj){
	if(obj.length!=11) return false;
	else if (obj.substring(0, 2) != "13" && obj.substring(0, 2) != "14" && obj.substring(0, 2) != "15" && obj.substring(0, 2) != "18" && obj.substring(0, 3) != "177" && obj.substring(0, 3) != "178") return false;
	else if(isNaN(obj)) return false;
	else  return true;
}
function isjsTell(str) {
    var result = str.match(/\d{3}-\d{8}|\d{4}-\d{7}/);
    if (result == null) return false;
    return true;
}

function isIdCardNo(v_card)
{
	
   var reg=/^d{15}(d{2}[0-9X])?$/i;

   if (!reg.test(v_card)){
       return false;
   }

   if(v_card.length==15){
       var n=new Date();
       var y=n.getFullYear();
       if(parseInt("19" + v_card.substr(6,2)) <1900 || parseInt("19" + v_card.substr(6,2)) >y){
           return false;
       }
       var birth="19" + v_card.substr(6,2) + "-" + v_card.substr(8,2) + "-" + v_card.substr(10,2);
       if(!isDate(birth)){
           return false;
       }
   }
   if(v_card.length==18){
       var n=new Date();
       var y=n.getFullYear();
       if(parseInt(v_card.substr(6,4)) <1900 || parseInt(v_card.substr(6,4)) >y){
           return false;
       }
       var birth=v_card.substr(6,4) + "-" + v_card.substr(10,2) + "-" + v_card.substr(12,2);
       if(!isDate(birth)){
           return false;
       }
       iW=new Array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2,1);
       iSum=0;
       for( i=0;i<17;i++){
           iC=v_card.charAt(i);
           iVal=parseInt(iC);
           iSum += iVal * iW[i];
       }
       iJYM=iSum % 11;
       if(iJYM == 0) sJYM="1";
       else if(iJYM == 1) sJYM="0";
       else if(iJYM == 2) sJYM="x";
       else if(iJYM == 3) sJYM="9";
       else if(iJYM == 4) sJYM="8";
       else if(iJYM == 5) sJYM="7";
       else if(iJYM == 6) sJYM="6";
       else if(iJYM == 7) sJYM="5";
       else if(iJYM == 8 ) sJYM="4";
       else if(iJYM == 9) sJYM="3";
       else if(iJYM == 10) sJYM="2";
       var cCheck=v_card.charAt(17).toLowerCase();
       if( cCheck != sJYM ){
           return false;
       }
   }
   try{
       var lvAreaId=v_card.substr(0,2);
       return lvAreaId == "11" || lvAreaId == "12" || lvAreaId == "13" || lvAreaId == "14" || lvAreaId == "15" || lvAreaId == "21" || lvAreaId == "22" || lvAreaId == "23" || lvAreaId == "31" || lvAreaId == "32" || lvAreaId == "33" || lvAreaId == "34" || lvAreaId == "35" || lvAreaId == "36" || lvAreaId == "37" || lvAreaId == "41" || lvAreaId == "42" || lvAreaId == "43" || lvAreaId == "44" || lvAreaId == "45" || lvAreaId == "46" || lvAreaId == "50" || lvAreaId == "51" || lvAreaId == "52" || lvAreaId == "53" || lvAreaId == "54" || lvAreaId == "61" || lvAreaId == "62" || lvAreaId == "63" || lvAreaId == "64" || lvAreaId == "65" || lvAreaId == "71" || lvAreaId == "82" || lvAreaId == "82";
   }
   catch(ex){
   }

   return true;
}

function isDate(strDate) {
   var strSeparator="-";
   var strDateArray;
   var intYear;
   var intMonth;
   var intDay;
   var boolLeapYear;
   strDateArray=strDate.split(strSeparator);
   if (strDateArray.length != 3) 
       return false;
   intYear=parseInt(strDateArray[0], 10);
   intMonth=parseInt(strDateArray[1], 10);
   intDay=parseInt(strDateArray[2], 10);
   if (isNaN(intYear) || isNaN(intMonth) || isNaN(intDay)) 
       return false;
   if (intMonth >12 || intMonth <1) 
       return false;
   if ((intMonth == 1 || intMonth == 3 || intMonth == 5 || intMonth == 7 || intMonth == 8 || intMonth == 10 || intMonth == 12) &&(intDay >31 || intDay <1)) 
       return false;
   if ((intMonth == 4 || intMonth == 6 || intMonth == 9 || intMonth == 11) &&(intDay >30 || intDay <1)) 
       return false;
   if (intMonth == 2) {
       if (intDay <1) 
           return false;
       boolLeapYear=false;
       if ((intYear % 100) == 0) {
           if ((intYear % 400) == 0) 
               boolLeapYear=true;
       }else {
           if ((intYear % 4) == 0) 
               boolLeapYear=true;
       }
       if (boolLeapYear) {
           if (intDay >29) 
               return false;
       }else {
           if (intDay >28) 
               return false;
       }
   }
   return true;
}
function checkDate(date){return true;}
$(document).ready(function(){
	$("#wysc").click(function(){
		$("#uploadname").val('');
		$("#upload_img").css("top","10%");
		$("#upload_img").show();
		$("#bg").show();
	})
	$("#qd").click(function(){
		var name=$("#uploadname").val();
		if(name==""){$("#close").click();return false;}
		var namearr=name.split("###");
		var i,upload="";
		for(i=0;i<namearr.length;i++){
			var num=i+1;
			upload+='<dd style="height:auto;" id="list'+i+'"><div style="float:left;"><img src="..'+namearr[i]+'" width="100" height="100"/></div><div style="float:left; margin-left:10px; line-height:30px;"><div><input class="imgshow" type="hidden" value="'+namearr[i]+'" />名称：<input class="titleshow" type="text" size="28" maxlength="10" value="环境展示'+num+'" /></div><div style="text-align:left;"><a href="javascript:del_upload(\''+namearr[i]+'\',\''+i+'\');">取消删除</a></div></div><div style="clear:both; height:5px;"></div></dd>';
		}
		$("#trlistone dl").html(upload);
		$("#trlistone").show();
		$("#trlisttwo").hide();
		$("#close").click();
	})
	$("#close").click(function(){
		$("#upload_img").hide();
		$("#bg").hide();
	})
})
function del_upload(dir,list){
	$.post(weburl+"/member/index.php?m=ajax&c=delupload&"+timestamp, {"str[]":[dir]},function(data) {
		if(data){
			$("#list"+list).remove();
			var upload=$("#trlistone dl").html();
			if(upload==""){
				$("#trlistone").hide();
				$("#trlisttwo").show();
			}
		}
	})
}

function checkshare(){
	var re = /^-?[0-9]*(\.\d*)?$|^-?d^(\.\d*)?$/;
	var smallday = $.trim($("#smallday").val());
	if(smallday!=""){
		if (!re.test(smallday)){
			layer.msg('购买天数填写不正确！', 2, 8);return false;  
		}
	}else{
		layer.msg('购买天数不能为空！', 2, 8);return false;   
	}
	return true;
}
 
$(function(){
	$(".zphstatus").click(function(){
		var zid=$(this).attr("zid");
		var pid=$(this).attr("pid");
		$.get(weburl+"/member/index.php?m=ajax&c=getzphcom&jobid="+pid+"&zid="+zid, function(data){
		    var data=eval('('+data+')'); 
			$("#title").html(data.title); 
			$("#stime").html(data.starttime); 
			$("#etime").html(data.endtime); 
			$("#address").html(data.address); 
			$("#cname").html(data.content); 
			$.layer({
				type : 1,
				title :'我的职位',  
				closeBtn : [0 , true],
				border : [10 , 0.3 , '#000', true],
				area : ['380px','auto'],
				page : {dom :"#infobox"}
			}); 
		});
	}); 
	
});
function m_checkAll(form){
	for (var i=0;i<form.elements.length;i++){
		var e = form.elements[i];
		if (e.Name != 'checkAll'&&e.disabled==false)
		e.checked = form.checkAll.checked; 
	}
} 
function really(name){
	var chk_value =[];    
	$('input[name="'+name+'"]:checked').each(function(){    
		chk_value.push($(this).val());   
	});   
	if(chk_value.length==0){
		layer.msg("请选择要删除的数据！",2,8);return false;
	}else{
		layer.confirm("确定删除吗？",function(){
			setTimeout(function(){$('#myform').submit()},0); 
		});
	} 
} 
function search_show(id){$(".cus-sel-opt-panel").hide();$("#"+id).show();}
function CheckForm(){
	var chk_value =[];    
	$('input[name="usertype"]:checked').each(function(){    
		chk_value.push($(this).val());   
	});
	if(chk_value.length==0){
		layer.msg("请选择购买类型！",2,8);return false;
	}
}
function pay_form(name){
	if($("#comvip").length!=0&&$("#comvip").val()==''){ 
		layer.msg("请选择购买类型！",2,8);return false;
	}
	if($("#price_int").length!=0&&$("#price_int").val()<1){ 
		layer.msg(name,2,8);return false; 
	} 
}
function Showsub1(){
	var oldpass = $("#oldpassword").val();
	var pass = $("#password").val();
	var repass = $("#repassword").val();
	oldpass=$.trim(oldpass);
	pass=$.trim(pass);
	repass=$.trim(repass);
	var flag = true;
	if(oldpass==""){
		$("#msg_oldpassword").html("<font color='red'>原始密码不能为空!</font>");
		flag = false;
	} else if(oldpass.length<6 || oldpass.length>20){
		$("#msg_oldpassword").html("<font color='red'>密码需在 6-20个字符之内!</font>");
		flag = false;
	} else{
		$("#msg_oldpassword").html("<font color='#008000'>输入成功!</font>");
	}
	if(pass==""){
		$("#msg_password").html("<font color='red'>新密码不能为空!</font>");
		flag = false;
	}else if(pass.length<6 || pass.length>20){
		$("#msg_password").html("<font color='red'>新密码需在 6-20个字符之内!</font>");
		flag = false;
	}else{
		$("#msg_password").html("<font color='#008000'>输入成功!</font>");
	}
	if(repass==""){
		$("#msg_repassword").html("<font color='red'>请再次确认新密码!</font>");
		flag = false;
	}else if(repass.length<6 || repass.length>20){
		$("#msg_repassword").html("<font color='red'>新密码需在 6-20个字符之内!</font>");
		flag = false;
	} if(repass!=pass){
		$("#msg_repassword").html("<font color='red'>两次密码输入不一致，请重新输入!</font>");
		flag = false;
	}else if(repass==pass && repass!=""){
		$("#msg_repassword").html("<font color='#008000'>输入成功!</font>");
	}
	if(oldpass==pass){
		layer.msg("旧密码和新密码一致，不需要修改！");return false;
	}
	return flag;
}


function reply_xin(id,uid,name,content){
	$("#pid").val(id);
	$("#fid").val(uid);
	$("#wnc").html("<div class='Reply_cont_name'><font color='#0066FF'>"+name+"</font> 给您留言：</div>"+content); 
	$.layer({
		type : 1,
		title : '回复',
		closeBtn : [0 , true],
		border : [10 , 0.3 , '#000', true],
		area : ['450px','auto'],
		page : {dom : '#reply'}
	});
} 
function check_xin(){
	if($("#content").val()==""){
		layer.msg('回复内容不能为空！', 2, 2);return false; 
	}	
}
function Showsub(){ 
	 var title = $("#title").val();
	 var con = $("#content").val();
 	 con=$.trim(con);
	 if(title==""){layer.msg('请填写留言标题！', 2, 2);return false;}
	 if(con==""){layer.msg('请填写留言内容！', 2, 2);return false;}			
}
function zhankaiShouqi(control){
	$(control).parent().find('.job_add_y_list:gt(3)').slideToggle();
	if($(control).html()=='更多'){
		$(control).html('收起');
	}else{
		$(control).html('更多');
	}
}

$(function () {
    $('.admincont_box').delegate('#keyword', 'focus', function () {
        if ($(this).val() == $(this).attr('placeholder')) {
            $(this).val('');
        }
    });
    $('body').click(function (evt) {
        if (evt.target.id != "status") {
            $('#status').next().next().hide();
        }
        if (evt.target.id != "province") {
            $('#province').next().next().hide();
        }           
        if (evt.target.id != "pr_button") {
            $('#pr_button').next().next().hide();
        }
        if (evt.target.id != "hy_button") {
            $('#hy_button').next().next().hide();
        }
        if (evt.target.id != "mun_button") {
            $('#mun_button').next().next().hide();
        }
        if (evt.target.id != "jobone_button") {
            $('#jobone_button').next().next().hide();
        }
        if (evt.target.id != "jobtwo_button") {
            $('#jobtwo_button').next().next().hide();
        }
        if (evt.target.id != "salary_button") {
            $('#salary_button').next().next().hide();
        }
        if (evt.target.id != "age_button") {
            $('#age_button').next().next().hide();
        }
        if (evt.target.id != "sex_button") {
            $('#sex_button').next().next().hide();
        }
        if (evt.target.id != "exp_button") {
            $('#exp_button').next().next().hide();
        }
        if (evt.target.id != "full_button") {
            $('#full_button').next().next().hide();
        }
        if (evt.target.id != "edu_button") {
            $('#edu_button').next().next().hide();
        }
        if (evt.target.id != "citys") {
            $('#citys').next().next().hide();
        }
        if (evt.target.id != "exp_button") {
            $('#exp_button').next().next().hide();
        }
        if (evt.target.id != "title_button") {
            $('#title_button').next().next().hide();
        }
        if (evt.target.id != "sid_button") {
            $('#sid_button').next().next().hide();
        }
        if (evt.target.id != "nid_button") {
            $('#nid_button').next().next().hide();
        }
        if (evt.target.id != "tnid") {
            $('#tnid').next().next().hide();
        }
        if (evt.target.id != "sid") {
            $('#sid').next().next().hide();
        }
        if (evt.target.id != "jobstatus") {
            $('#jobstatus').next().next().hide();
        }
	if($(evt.target).parents("#job_hy").length==0 && evt.target.id != "hy") {
	   $('#job_hy').hide();
	}
	if($(evt.target).parents("#job_qyhy").length==0 && evt.target.id != "qyhy") {
	   $('#job_qyhy').hide();
	}
	if($(evt.target).parents("#job_pr").length==0 && evt.target.id != "pr") {
	   $('#job_pr').hide();
	}
	if($(evt.target).parents("#job_lt_salary").length==0 && evt.target.id !="lt_salary"){
	    $('#job_lt_salary').hide();
	}
	if($(evt.target).parents("#job_lt_full").length==0 && evt.target.id !="lt_full"){
	    $('#job_lt_full').hide();
	}	
	if($(evt.target).parents("#job_salary").length==0 && evt.target.id != "salary") {
	   $('#job_salary').hide();
	}
	if($(evt.target).parents("#job_report").length==0 && evt.target.id != "report") {
	   $('#job_report').hide();
	}	
	if($(evt.target).parents("#job_province").length==0 && evt.target.id != "province") {
	   $('#job_province').hide();
	}	
	if($(evt.target).parents("#job_twocity").length==0 && evt.target.id != "twocity") {
	   $('#job_twocity').hide();
	}	
	if($(evt.target).parents("#job_threecity").length==0 && evt.target.id != "threecity") {
	   $('#job_threecity').hide();
	}	
	if($(evt.target).parents("#job_skillc").length==0 && evt.target.id != "skillc") {
	   $('#job_skillc').hide();
	}
	if($(evt.target).parents("#job_level").length==0 && evt.target.id != "level") {
	   $('#job_level').hide();
	}	
	if($(evt.target).parents("#job_marriage").length==0 && evt.target.id != "marriage") {
	   $('#job_marriage').hide();
	}
	if($(evt.target).parents("#job_educ").length==0 && evt.target.id != "educ") {
	   $('#job_educ').hide();
	}
	if($(evt.target).parents("#job_edu").length==0 && evt.target.id != "edu") {
	   $('#job_edu').hide();
	}	
	if($(evt.target).parents("#job_type").length==0 && evt.target.id != "type") {
	   $("#job_type").hide();
	}
	if($(evt.target).parents("#job_edu").length==0 && evt.target.id != "edu") {
	   $('#job_edu').hide();
	}
	if($(evt.target).parents("#job_mun").length==0 && evt.target.id != "mun") {
	   $("#job_mun").hide();
	}
	if($(evt.target).parents("#job_exp").length==0 && evt.target.id != "exp") {
	   $("#job_exp").hide();
	}
	if($(evt.target).parents("#job_qypr").length==0 && evt.target.id != "qypr") {
	   $("#job_qypr").hide();
	}	
	if($(evt.target).parents("#job_mun").length==0 && evt.target.id != "mun") {
	   $("#job_mun").hide();
	}	
	if($(evt.target).parents("#job_qyprovince").length==0 && evt.target.id != "qyprovince") {
	   $("#job_qyprovince").hide();
	}
	if($(evt.target).parents("#job_ltage").length==0 && evt.target.id != "ltage") {
	   $("#job_ltage").hide();
	}
	if($(evt.target).parents("#job_ltsex").length==0 && evt.target.id != "ltsex") {
	   $("#job_ltsex").hide();
	}
	if($(evt.target).parents("#job_type1").length==0 && evt.target.id != "jobone_name") {
	   $("#job_type1").hide();
	}

	if($(evt.target).parents("#job_ltexp").length==0 && evt.target.id != "ltexp") {
	   $("#job_ltexp").hide();
	}
	if($(evt.target).parents("#job_citys").length==0 && evt.target.id != "citys") {
	   $("#job_citys").hide();
	}	
	if($(evt.target).parents("#job_three_city").length==0 && evt.target.id != "three_city") {
	   $("#job_three_city").hide();
	}	
	if($(evt.target).parents("#job_ltedu").length==0 && evt.target.id != "ltedu") {
	   $("#job_ltedu").hide();
	} 
	if($(evt.target).parents("#job_basic_info").length==0 && evt.target.id != "basic_info") {
	   $("#job_basic_info").hide();
	} 
	if($(evt.target).parents("#job_job1").length==0 && evt.target.id != "job1") {
	   $("#job_job1").hide();
	}
	if($(evt.target).parents("#job_job1_son").length==0 && evt.target.id != "job1_son") {
	   $("#job_job1_son").hide();
	}
	if($(evt.target).parents("#job_job_post").length==0 && evt.target.id != "job_post") {
	   $("#job_job_post").hide();
	} 
	if($(evt.target).parents("#job_number").length==0 && evt.target.id !="number"){
	    $('#job_number').hide();
	}
    if($(evt.target).parents("#job_age").length==0 && evt.target.id !="age"){
	    $('#job_age').hide();
	}	
	if($(evt.target).parents("#job_sex").length==0 && evt.target.id !="sex"){
	    $("#job_sex").hide();
	}
	if($(evt.target).parents("#banklist").length==0 && evt.target.id !="bankname"){
	    $("#banklist").hide();
	}
	if($(evt.target).parents("#job_ltfull").length==0 && evt.target.id !="ltfull"){
	    $("#job_ltfull").hide();
	}
	if($(evt.target).parents("#job_ltsalary").length==0 && evt.target.id !="ltsalary"){
	    $("#job_ltsalary").hide();
	}
	if ($(evt.target).parents(".index_resume_my_n_list").length == 0 && evt.target.id != "show_resume" && evt.target.parentNode.id != "show_resume" && !$(evt.target).hasClass('index_resume_my_n_sh') && !$(evt.target).parent().hasClass('index_resume_my_n_sh')) {
	    $(".index_resume_my_n_list").hide();
	}
   });
})
function selects(id,type,name){
	$("#job_"+type).hide();
	$("#"+type).val(name);
	$("#"+type+"id").val(id);
}
function select_city(id,type,name,gettype,ptype){
	$("#job_"+type).hide();
	$("#"+type).val(name);
	$("#" + type + "id").val(id);
	$('#by_citysid').html('');
	if(type=='qyprovince'){
		$("#citysid").val('');
	} 
	if(type=='province'){
		$("#citys").val('请选择城市');
		$("#three_city").val('请选择城市');
		$("#citysid").val('');
		$("#three_cityid").val('');
	} 
	if(type=='job1'){
		$("#job1_son").val('请选择职位');
		$("#job1_sonid").val('');
		$("#job_post").val('请选择职位'); 
		$("#job_postid").val('');
	}
	$.post(weburl+"/member/index.php?m=ajax&c=ajax_city",{id:id,gettype:gettype,ptype:ptype},function(data){
        $("#city_name").html(data);
		var jobaddtype=$("#jobaddtype").val();
		if(jobaddtype=="lietou"){
			data='<div class="m_post_job01">'+data+'</div>';
		}else if(jobaddtype=="ltinfo"){
			data='<div class="m_name_area">'+data+'</div>';
		}
		if(ptype=='job'){ 
			$("#job_"+gettype).html(data);
			if(gettype=="job1_son"){
				if(data==""){
					$("#job_"+gettype).hide();
				}else{
					$("#job_"+gettype).show();
				}
			}else if(gettype=="job_post"){
				$("#job_post").parents().show();
				$("#job_"+gettype).show();
			}
		}else{
			if(gettype=="citys"){$("#"+gettype).val("请选择城市");} 
			$("#job_"+gettype).html(data);
			if(type=='citys'){
				$("#cityshowth").show();
				if(jobaddtype=="ltinfo"){
					$("#by_citysid").attr("class","m_name_gh");
				}
			}else{
				$("#by_citysid").attr("class","");
			}
		} 
	})
}  
function selectjobone(id,type,name,gettype){
	$("#"+type).val(id);
	$("#"+type+"_name").val(name);
	$("#jobtwo").val("");
	$("#jobtwo_name").val("请选择");
	$.post(weburl+"/member/index.php?m=ajax&c=ajax_ltjobone&"+timestamp, {"str":id},function(data) {
		if(data!=""){
			$('#job_type2').find("ul").html(data); 
		}
	});
	$("#job_type1").hide();
}
function selectjobtwo(id,type,name,gettype){
	$("#"+type).val(id);
	$("#"+type+"_name").val(name);
	$("#job_type2").hide();
}
function checktpl(id){

	var	buytpl=$("#buytpl_"+id).val();
	var name=$("input[name=tplname"+id+"]").val();
	var msg;
	var p=$("#list_tpl_"+id).html().replace("模板价格：","");
	$('#tplid').val(id);
	
	if(buytpl==1){
		msg="确定使用该模板？";
	}else{
		msg="确定使用"+name+",扣除"+p+"？";
	}
	layer.confirm(msg,function(){ 
		setTimeout(function(){$('#myform').submit()},0);
	}); 
}
function job_refresh(){
	layer.confirm("刷新次数已用完，是否先购买特权？",function(){
		window.location.href =weburl+"/member/index.php?c=pay";window.event.returnValue = false;return false; 
	});
} 
function really_read(name){ 
	var chk_value =[];    
	$('input[name="'+name+'"]:checked').each(function(){    
		chk_value.push($(this).val());   
	});   
	if(chk_value.length==0){
		layer.msg("请选择要阅读的数据！",2,8);return false;
	}else{
		layer.confirm("确定阅读吗？",function(){
			$.post("index.php?c=hr&act=hrset",{ids:chk_value,ajax:1},function(data){ 
				var data=eval('('+data+')');
				if(data.url=='1'){
					parent.layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.reload();});return false;
				}else{
					parent.layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.href=data.url;});return false;
				}
			})
		});
	} 
}
function del_pay(oid){ 
	layer.confirm('是否取消该订单？', function(){
		$.get("index.php?c=paylog&act=del&id="+oid,function(msg){
			if(msg=='0'){
				layer.msg('非法操作！', 2, 0);return false;  
			}else{
				layer.msg('取消成功！', 2, 9,function(){location.reload();});return false;  
			}
		});
	});  
} 
function paylog_remark(){ 
	var id=$("#paylog_id").val();
	var content=$.trim($("#alertcontent").val());
	if(id<1){
		layer.msg('非法操作！', 2, 8);return false; 
	}
	if(content==''){
		layer.msg('备注内容不能为空！', 2, 8);return false; 
	} 
}
function paylog_invoice(){
	var title=$.trim($("#title").val());
	var link_man=$.trim($("#link_man").val());
	var link_moblie=$.trim($("#link_moblie").val());
	var address=$.trim($("#address").val());
	if(title==''||link_man==''||link_moblie==''||address==''){
		layer.msg('发票抬头、联系人、联系电话、邮寄地址均不能为空！', 2, 8);return false;
	}
	
}
function check_rating_coupon(id){
	var value=$("#comvip option:selected").attr("price");
	if(value!=""){
		$("#com_vip_price").val(value);
		$("#span_com_vip_price").html(value);
	}else{
		$("#com_vip_price").val('0');
		$("#span_com_vip_price").html('0');
	}
}
function switchJob(num,element,classname,itemCommonclassname,itemclassname){
	$("."+classname).removeClass(classname+"_on");
	$(element).addClass(classname+"_on");
	$("."+itemCommonclassname).hide();
	$("."+itemclassname).show();
}
function resumetop(eid,date){
	$("input[name='eid']").val(eid);
	$("#topdate").html(date);
	$.layer({
		type : 1,
		title :'简历置顶', 
		closeBtn : [0 , true],
		border : [10 , 0.3 , '#000', true],
		area : ['400px','200px'],
		page : {dom :"#resumetop"}
	});
}
function returnmessage(frame_id){ 
	if(frame_id==''||frame_id==undefined){
		frame_id='supportiframe';
	}
	var message = $(window.frames[frame_id].document).find("#layer_msg").val(); 
	if(message != null){
		var url=$(window.frames[frame_id].document).find("#layer_url").val();
		var layer_time=$(window.frames[frame_id].document).find("#layer_time").val();
		var layer_st=$(window.frames[frame_id].document).find("#layer_st").val();
		if(url=='1'){
			layer.msg(message, layer_time, Number(layer_st),function(){ location.reload();});
		}else if(url==''){
			layer.msg(message, layer_time, Number(layer_st));
		}else{
			layer.msg(message, layer_time, Number(layer_st),function(){location.href = url;});
		}
	}
}

function jobadd_url(num,integral_job,integral_pricename,type){
	if(num==0){
		var msg='套餐已用完，请先购买会员！';
		layer.confirm(msg, function(){location.href='index.php?c=right';})
	}else if(num==1){
		location.href='index.php?c=jobadd';
	}else if(num==2){
		var msg='套餐已用完，继续操作将会扣除'+integral_job+' '+integral_pricename+'，是否继续？';
		layer.confirm(msg, function(){location.href='index.php?c=jobadd';});
	}
}