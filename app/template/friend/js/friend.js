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
function CheckPost1(){
	var content = $("#content").val();
	var touid = $("#touid").val();
	var myuid = $("#myuid").val();
	if(myuid==touid){ 
		layer.msg('不能给自己留言！', 2, 3);return false;
	}
	if(content=="有多久没给好友留言了？"||content=='回复:'){
		content='';
	}
	if(content==""){ 
		layer.msg('内容不能为空！', 2, 2);return false;
	}
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
 
function addfriend(id,url){ 
	$.post(url,{id:id},function(msg){
		if(msg=='4'){
			layer.msg('不能关注自己！', 2, 8);return false; 
		}else if(msg=='3'){
			layer.msg('请先登录！', 2, 8);return false; 
		}else if(msg=='1'){
			$(".addfriend"+id).remove();
		} 
	});
}
function addmseeage(){
	var content = $.trim($("#content").val());
	if($.trim(content)==""){ 
		layer.msg('留言不能为空！', 2, 2);return false;
	}
} 
//发布动态
function submitstate(){
	var html = $.trim($("#content").val()); 
	if(html==""){ 
		layer.msg('内容不能为空！', 2, 2);return false;
	}
}
//回复动态
function submitreply(id,fid,url){
	var content = $("#reply_"+id).val();
	content=$.trim(content);
	if($.trim(content)==""){
		$("#reply_"+id).val("");
		layer.msg('请输入回复内容！', 2, 2);return false; 
	}
	$.post(url,{nid:id,reply:content,fid:fid},function(data){
		if(data==1){ 
			layer.msg('请先登录！', 2, 3);return false;
		}else{
			var data = eval("("+data+")");
			var content = "";
			content = '<div class="Personals_cont_dy_pl"><div class="Personals_cont_dy_pl_tx"><img src="'+data.pic+'" width="28" height="35"></div><div class="Personals_cont_dy_pl_user"><div class="Personals_cont_dy_pl_user_n"><a href="'+data.url+'">'+data.nickname+'</a>: '+data.reply+'</div><div class="Personals_cont_dy_pl_user_m">'+data.ctime+'</div></div></div>';
			$("#commentlist_"+id).append(content);
			$("#comment_"+id).hide();
			$("#reply_"+id).val("");
			$("#comment"+id).show();	
		}
	});
}
/*
	2013-7-27  回复他人 lgl
*/
function reply_msg(pid,fid,f_name){ 
	$("#comment_"+pid).show();
	$("#fid").val(fid);
	$("#f_name").val(f_name);
	$("#replys_"+pid).attr("placeholder","@"+f_name+": ")
}
function reply_dynamic(id,nid,my_pic,uid,u_name){
	var r_contetn=$("#reply_"+id).val();
	if(r_contetn==""){
		layer.msg('请输入回复内容！', 2, 2);return false; 
	}else{
		var fid=$('#fid').val();
		var f_name=$('#f_name').val(); 
		$.post(posturl,{pid:id,content:r_contetn,fid:fid,f_name:f_name,nid:nid},function(data){
			var result_r=data.split("||");
			if(result_r[0]=='1'){
				var html="";
				html="<div id=\"commentlist_"+id+"\"><div class=\"Personals_cont_dy_pl\"><div class=\"Personals_cont_dy_pl_tx\"><img src=\""+my_pic+"\" width=\"28\" height=\"35\" onerror=\"showImgDelay(this,'"+errorimg+"',2);\"></div><div class=\"Personals_cont_dy_pl_user\"><div class=\"Personals_cont_dy_pl_user_n\"><a href=\""+friendurl+"\" target='_blank'>"+u_name+"</a> 回复 "+f_name+": "+r_contetn+"</div><div class=\"Personals_cont_dy_pl_user_m\">"+result_r[1]+"<span style=\"float:right\"><a href=\"javascript:void(0);\" onclick=\"reply_msg('"+id+"','"+uid+"','"+u_name+"','"+uid+"','"+u_name+"');\">回复</a></span></div></div></div></div>";
				$("#msg_"+id).append(html);
				$("#reply_"+id).val("");
			}else{ 
				layer.msg('回复失败！', 2, 8);return false;
			}
		});
		onblur_reply(id);
	} 
}
function onblur_reply(id){
	$("#comment_"+id).hide();
	$("#reply_"+id).val("");
	$("#colornum_"+id).html("0");
}
function get_allmsg(id){ 
	var display=$("div[name='hide_"+id+"']").css("display"); 
	if(display=='none'){
		$("div[name='hide_"+id+"']").show();
		$("#click_"+id).html("收起评论");
	}else{
		$("div[name='hide_"+id+"']").hide();
		$("#click_"+id).html("查看全部评论");
	} 
} 
function clicktext(id){ 
	$("#comment_"+id).show();
	$("#comment"+id).hide();
	$("#reply_"+id).focus(); 	
}
function onblurtext(id){
	var content = $("#reply_"+id).val();
	content=$.trim(content);
	if(content==""){
		$("#reply_"+id).val("");
		$("#comment_"+id).hide();
		$("#comment"+id).show();
	}
}
function texthide(id){
	$("#submit_"+id).hide();
}
function showit(url){
	location.href=url; 
}
function reply(name,id){
	$("#content").val("");
	$("#content").val('回复'+name+':');
	$("#touid").val(id);
	myform.content.focus();
}

function checkLength(num,id) {
	var con = $("#reply_"+id).val();
	var content = con.length;
	
	if (con.length > num) { 
		con = con.substring(0, num);
		$("#reply_"+id).val(con); 
	} 
	if(con.length=="0"){
		$("#colornum_"+id).html("0");
	}else{
		$("#colornum_"+id).html(con.length);
	} 
}	 
function layer_del(msg,url){
	layer.confirm(msg, function(){
		$.get(url,function(data){ 
			var data=eval('('+data+')');  
			if(data.url=='1'){
				layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.reload();});return false;
			}else{
				layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.href=data.url;});return false;
			} 
		});
	});
} 