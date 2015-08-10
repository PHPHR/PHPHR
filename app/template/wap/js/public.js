function showMoreNav(){
	$(".subnav").toggle();
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
function layer_load(msg){
	layer.open({
		type: 2,
		content: msg
	});
};
function layer_del(msg,url){ 
	if(msg==''){ 
		layer_load('执行中，请稍候...');
		$.get(url,function(data){
			layer.closeAll();
			var data=eval('('+data+')');
			if(data.url=='1'){ 
				layermsg(data.msg,Number(data.tm),function(){location.reload();});return false;
			}else{
				layermsg(data.msg,Number(data.tm),function(){location.href=data.url;});return false;
			}
		});
	}else{
		layer.open({
			content: msg,
			btn: ['确认', '取消'],
			shadeClose: false,
			yes: function(){
				layer.closeAll();
				layer_load('执行中，请稍候...');
				$.get(url,function(data){
					layer.closeAll();
					var data=eval('('+data+')');
					if(data.url=='1'){ 
						layermsg(data.msg,Number(data.tm),function(){location.reload();});return false;
					}else{
						layermsg(data.msg,Number(data.tm),function(){location.href=data.url;});return false;
					}
				});
			} 
		}); 
	}
}
function checkshowjob(type) {
    window.show_scrolltop = document.body.scrollTop;
    document.body.scrollTop = 0;
	if(type=='once'||type=='tiny'){
		layer.open({
			type:1,
			content: $("#"+type+"list").html(),
			shadeClose: false
		});return;
	}else{
		$("#"+type+"list").show();
		checkhide('info'); 
	}
}
function checkhide(id){ 
	$("#"+id+"button").show();
	$("#"+id).hide();
}
function checkjob1(id,type){
	var style=$("#"+type+"list"+id).attr("style");
	$(".onelist").addClass("lookshow");
	$(".lookhide").attr("style","display: none;");
	if(style=="display: none;"){
		$("#"+type+"list"+id).show();
		$("#"+type+id).removeClass("lookshow");
	}
}
function checkjob2(id,type){
	if($("#citylevel").length>0){
		if(parseInt($("#citylevel").val())==2){
			$("#cityclassbutton").val($(event.target).html());
			$("#cityclassbutton").html($(event.target).html());
			$("#three_cityid").val(id);
			$("#cityid").val(id);
			Close('city');
			return;
		}
	}
	var style=$("#"+type+"post"+id).attr("style");
	$(".post_show_three").attr("style","display: none;");
	if(style=="display: none;"){
		$("#"+type+"post"+id).show();
	}
} 
function checkedcity(id,name){
	$("#cityclassbutton").val(name);
	$("#cityclassbutton").html(name);
	$("#three_cityid").val(id);
	Close('city');
}
function checked_input(id){
	var check_length = $("input[name='jobclass']:checked").length;
	if(check_length>5){ 
		$("#r"+id).attr("checked",false);
		layermsg('您最多只能选择五个！');  
	}
}
function realy() {
	var info="";
	var value=""; 
	$("input[name='jobclass']:checked").each(function(){
		var obj = $(this).val();
		var name = $(this).attr("data");
		if(info==""){
			info=obj;
			value=name;
		}else{
			info=info+","+obj;
			value=value+","+name;
		}
	})
	if(info==""){
		layermsg("请选择职位类别！");return false;
	}else{
		var waptype=$("#waptype").val();
		if(waptype==1){
			var url=$("#searchurl").val();
			$.post(wapurl+"/?c=job&a=ajax_url",{url:url,type:"jobin",id:info},function(data){
				location.href=data;
			})
		}else{
			$("#job_classid").val(info);
			$("#jobclassbutton").val(value);
			$("#jobclassbutton").html(value);
			Close("job");
		}
	}
}
function removes(){
	$("#jobclassbutton").val("请选择职位类别");
	$("#job_classid").val(""); 
	$(".onelist").attr("class","onelist lookshow");
	$(".onelist>.lookhide").hide();
	$(".post_show_three").hide();
	$("input[name='jobclass']").removeAttr("checked");
}
function Close(type) {
    document.body.scrollTop = window.show_scrolltop;
	$("#"+type+"list>.onelist").attr("class","onelist lookshow");
	$("#"+type+"list>.onelist>.lookhide").hide();
	$("#"+type+"list>.post_show_three").hide();
	$("#"+type+"list").hide(); 
}
function checkfrom(target_form) {
	var username=$.trim($("#username").val());
	if(username==""){ 
		layermsg("用户名不能为空！");return false;
	}else if(username.length<2||username.length>16){
		layermsg("用户名长度应在2-16位！");return false;
	} 
	var email=$.trim($("#email").val()); 
    var myreg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((.[a-zA-Z0-9_-]{2,3}){1,2})$/;
    if(!myreg.test(email)){
		layermsg("邮箱格式错误！");return false;
	} 
	var password=$.trim($("#password").val());
	var password2=$.trim($("#password2").val());
	if(password==""){
		layermsg("密码不能为空！");return false;
	}else if(password.length<6||password.length>20){
		layermsg("密码长度应在6-20位！");return false;
	}
	if(password!=password2){
		layermsg("两次密码不一致！");return false;
	}
}
function ckpwd(target_form) {
	var oldpassword=$.trim($("input[name='oldpassword']").val());
	var password1=$.trim($("input[name='password1']").val());
	var password2=$.trim($("input[name='password2']").val());
	if(oldpassword==''||password1==''||password2==''){
		layermsg("旧密码、新密码、确认密码均不能为空！");return false;
	}
	if(oldpassword==password1){
		layermsg("旧密码和新密码一致，不需要修改！");return false;
	}
	if(password1!=password2){
		layermsg("两次密码不一致！");return false;
	}
	post2ajax(target_form);
	return false;
}
function isdel(url){
	layer.open({
		content: '是否删除该数据？',
		btn: ['确认', '取消'],
		shadeClose: false,
		yes: function(){
			location.href =url;
		} 
	});
}
function islogout(url,msg) {
    layer.open({
        content: msg ? msg : '确认退出吗？',
        btn: ['确认', '取消'],
        shadeClose: false,
        yes: function () {
            location.href = url;
        }
    });
}
 
function comjob(id){
	if(id>0){ 
		$.post(wapurl+"/index.php?c=ajax&a=wap_job",{id:id,type:1},function(data){  
			$("select[name='job1_son']").html(data);
		})
	}
}
function comcity(id,name){
	if(id>0){
		$.post(wapurl+"/index.php?c=ajax&a=wap_city",{id:id,type:1},function(data){  
			$("select[name='"+name+"']").html(data); 
		})
	} 
	if(name=='cityid'){$("select[name='three_cityid']").html("<option value=\"\">--请选择--</option>");} 
}
function mlogin(target_form) {
	var username=$.trim($("#username").val());
	var password=$.trim($("#password").val()); 
	if(username==''||password==''){
		layermsg('用户名或密码均不能为空！');return false; 
	}
	post2ajax(target_form);
	return false;
}  

function cktiny(target_form) {
	var name=$.trim($("input[name='username']").val()); 
	var job=$.trim($("input[name='job']").val());
	var mobile=$.trim($("input[name='mobile']").val());
	var production=$.trim($("#production").val());
	var password=$.trim($("input[name='password']").val()); 
	if(name==''){layermsg('姓名不能为空！');return false; }
	if(job==''){layermsg('意向职位不能为空！');return false; }
	if(mobile==''){
		layermsg('手机号不能为空！');
		return false; 
	}else{
		var reg= /^[1][34578]\d{9}$/;   
		if(!reg.test(mobile)){ 
			layermsg('手机格式错误！');
			return false;
		}
	}
	if(production==''){layermsg('自我介绍不能为空！');return false; } 
	if (password == '') { layermsg('密码不能为空！'); return false; }
	post2ajax(target_form);
	return false;
}
function ckonce(target_form) {
	var title=$.trim($("input[name='title']").val()); 
	var mans=$.trim($("input[name='mans']").val()); 
	var companyname=$.trim($("input[name='companyname']").val()); 
	var linkman=$.trim($("input[name='linkman']").val()); 
	var phone=$.trim($("input[name='phone']").val()); 
	var address=$.trim($("input[name='address']").val()); 
	var password=$.trim($("input[name='password']").val()); 
	var require=$.trim($("textarea[name='require']").val()); 
	if(title==''){layermsg('招聘名称不能为空！');return false; } 
	if(mans==''){layermsg('招聘人数不能为空！');return false; } 
	if(companyname==''){layermsg('店面名称不能为空！');return false; } 
	if(linkman==''){layermsg('联系人不能为空！');return false; } 
	if(phone==''){layermsg('联系电话不能为空！');return false; } 
	if(address==''){layermsg('联系地址不能为空！');return false; } 
	if(require==''){layermsg('要求不能为空！');return false; } 
	if (password == '') { layermsg('密码不能为空！'); return false; }
	post2ajax(target_form);
	return false;
}

function islayer(){
	if($.trim($("#layermsg").val())){
		var msg=$.trim($("#layermsg").val());
		var url=$.trim($("#layerurl").val());
		if(url){
			if(url=='1'){url=location.href;}else{
				layermsg(msg,2,function(){location.href = url;});
			} 
		}else{ 
			layermsg(msg,2);	
		}
	} 
}
function layermsg(content,time,end){ 
	layer.open({
		content: content, 
		time: time === undefined ? 2 : time,
		end: end
	});
	return false;
}
function layeralert(title,content,time,end){ 
	layer.open({
		title: [title,'background-color:#0099CC; color:#fff;'],
		content: content, 
		time: time === undefined ? 2 : time,
		end:end===undefined?'':function(){location.href = end;}
	});
}
function really(name){
	var chk_value =[];    
	$('input[name="'+name+'"]:checked').each(function(){    
		chk_value.push($(this).val());   
	});   
	if(chk_value.length==0){
		layermsg("请选择要删除的数据！",2,8);return false;
	}else{
		layer.open({
			content: '确定删除吗？',
			btn: ['确认', '取消'],
			shadeClose: false,
			yes: function(){
				setTimeout(function(){$('#myform').submit()},0); 
			} 
		});
	} 
}
//全选
function m_checkAll(form){
	var elements=$("input[name='"+"delid[]"+"']");
	for (var i=0;i<elements.length;i++){
		var e = elements.eq(i)[0];
		e.checked = $("#checkAll")[0].checked; 
	}
} 
function checkAll(name){
	$("input[name="+name+"]").attr("checked",true);
} 
function getDaysHtml(year,month){
	var days=30;
	if((month==1)||(month==3)||(month==4)||(month==7)||(month==8)||(month==10)||(month==12)){
		days=31;
	}else if((month==4)||(month==6)||(month==9)||(month==11)){
		days=30;
	}else{
		if((year%4)==0){
			days=29;
		}else{
			days=28;
		}
	}
	var daysHtml='';
	for(var i=1;i<=days;i++){
		daysHtml+="<option value='"+i+"'>"+i+"</option>"
	}
	return daysHtml;
}
function selectMonth(yearid,monthid,dayid){
	$("#"+dayid).html(getDaysHtml(parseInt($("#"+yearid).val()),parseInt($("#"+monthid).val())));
}
function setSelectDay(dayid,day){
	$("#"+dayid).val(day);
}
function isjsMobile(obj) {
    if (obj.length != 11) return false;
    else if (obj.substring(0, 2) != "13" && obj.substring(0, 2) != "14" && obj.substring(0, 2) != "15" && obj.substring(0, 2) != "18" && obj.substring(0, 3) != "177") return false;
    else if (isNaN(obj)) return false;
    else return true;
}
function isjsTell(str) {
    var result = str.match(/\d{3}-\d{8}|\d{4}-\d{7}/);
    if (result == null) return false;
    return true;
}
$(document).ready(function () {
    $(document).delegate('.tiny_show_tckbox_h1_icon', 'click', function () {
        layer.closeAll();
    });
	$("#price_int").blur(function(){
		var value=$(this).val();
		var proportion=$(this).attr("int");
		$("#com_vip_price").val(value/proportion);
		$("#span_com_vip_price").html(value/proportion);
	});
	$("#click_invite").click(function(){
		var uid=$("#uid").val();
		var content=$("#content").val();
		var username=$("#username").val();
		var job=$("#jobname").val();
		var intertime=$("#intertime").val();
		var linkman=$("#linkman").val();
		var linktel=$("#linktel").val();
		var address=$("#address").val();
		job=job.split("+");
		var jobname=job[0];
		var jobid=job[1];
		if($("#update_yq").attr("checked")=='checked'){
			var update_yq=1;
		}else{
			var update_yq=0;
		}
		if($.trim(content)==""){
			layermsg('内容不能为空！');return false;
		}
		if ((isjsTell(linktel) != true) && (isjsMobile(linktel) != true) && ($.trim(linktel) != '')) {
		    layermsg('电话格式错误！', 2, 2); return false;
		}
		layer_load('执行中，请稍候...');
		$.post(wapurl+"/index.php?c=ajax&a=sava_ajaxresume",{uid:uid,content:content,username:username,jobname:jobname,update_yq:update_yq,address:address,linkman:linkman,linktel:linktel,intertime:intertime,jobid:jobid},function(data){
			layer.closeAll();
			var data=eval('('+data+')');
			var status=data.status;
			var integral=data.integral;
			if(status==8){
				layermsg('您已被该用户列如黑名单！');return false;
			}else if(status==9){
				layermsg('该用户已被你列入黑名单！');return false;
			}else if(!status || status==0){ 
				layermsg('请先登录！',2);
			}else if(status==5){
				layermsg('您还有'+integral+integral_pricename+'，无法邀请面试！',2,function(){history.back();}); 
			}else if(status==3){
				layermsg('您已成功邀请！',2,function(){history.back();});
			}else if(status==7){
				layermsg('您已经邀请过该人才，请不要重复邀请！',2,function(){history.back();});
			}
		});
	});
});
function checkOncePassword(id){
	if($(".layermmain #once_password").val()==''){
		layermsg('请输入密码');
		return;
	}
	var operation_type=$("#operation_type").val();
	$.post(wapurl + "/index.php?c=ajax&a=checkOncePassword", { id: id, password: $(".layermmain #once_password").val(), operation_type: operation_type }, function (data) {
	    if (data == '1') {
	        var url = '',msg='';
	        if (operation_type == 'refresh') {
	            url = wapurl + 'index.php?c=once&a=show&id=' + id;
	            msg = '刷新成功！';
	        } else if (operation_type == 'edit') {
	            url = wapurl + 'index.php?c=once&a=add&id=' + id;
	            msg = '验证通过！';
	        } else if (operation_type == 'remove') {
	            url = wapurl + 'index.php?c=once';
	            msg = '删除成功！';
	        }
	        layermsg(msg, 2, function () { location.href = url; });
		}else{
			layermsg('验证失败！',2,function(){});
		}
	});
}
function checkTinyPassword(id){
	if($(".layermmain #tiny_password").val()==''){
		layermsg('请输入密码');
		return;
	}
	var operation_type = $("#operation_type").val();
	$.post(wapurl + "/index.php?c=ajax&a=checkTinyPassword", { id: id, password: $(".layermmain #tiny_password").val(), operation_type: operation_type }, function (data) {
	    if (data == '1') {
	        var url = '', msg = '';
	        if (operation_type == 'refresh') {
	            url = wapurl + 'index.php?c=tiny&a=show&id=' + id;
	            msg = '刷新成功！';
	        } else if (operation_type == 'edit') {
	            url = wapurl + 'index.php?c=tiny&a=add&id=' + id;
	            msg = '验证通过！';
	        } else if (operation_type == 'remove') {
	            url = wapurl + 'index.php?c=tiny';
	            msg = '删除成功！';
	        }
	        layermsg(msg, 2, function () { location.href = url; });
	    } else {
	        layermsg('验证失败！', 2, function () { });
	    }
	});
}
function form2json(target_form) {
    var json_form = '';
    $(target_form).find('input,select,textarea').each(function () {
        if ($(this).attr('name')) {
            json_form += ',' + $(this).attr('name') + ':"' + $(this).val()+'"';
        }
    });
    return eval('({' + json_form.substring(1) + '})');
}
function formfile2json(target_form) {
    var json_form = '';
    var formData = new FormData(target_form);
    /*$(target_form).find('input,select').each(function () {
        if ($(this).attr('name')) {
            alert($(this)[0].type);
            if ($(this)[0].type == 'file') {
                alert('adsfad');
                
            } else {
                formData.append($(this).attr('name'), $(this).val());
            }
        }
    });*/
    
    //alert(formData.length);
    //formData.append('file', $('input[type=file]', target_form).get(0).files[0]);
    //alert(formData);
    return formData;
}
function form2string(target_form) {
    var json_form = '';
    $(target_form).find('input,select').each(function () {
        if ($(this).attr('name')) {
            json_form += '&' + $(this).attr('name') + '=' + $(this).val();
        }
    });
    return json_form;
}
function post2ajax(target_form) {
    if ($('input[type=file]', target_form).length > 0) {
        $.ajax({
            url: $(target_form).attr('action'),
            contentType: "multipart/form-data",
            data: formfile2json(target_form),
            processData: false,
            type: 'POST',
            success: function () {
                var json_data = eval('(' + data + ')');
                if (json_data.msg) {
                    layermsg(json_data.msg, json_data.tm, function () { if (json_data.url) { location.href = json_data.url; } });
                } else if (json_data.url) {
                    location.href = json_data.url;
                }
            }
        });
    } else {
        if ($(target_form).attr('action') == 'get') {
            $.get($(target_form).attr('action') + form2string(target_form), function (data) {
                var json_data = eval('(' + data + ')');
                if (json_data.msg) {
                    layermsg(json_data.msg, json_data.tm, function () { if (json_data.url) { location.href = json_data.url; } });
                } else if (json_data.url) {
                    location.href = json_data.url;
                }
            });
        } else {		
            $.post($(target_form).attr('action'), form2json(target_form), function (data) {
                var json_data = eval('(' + data + ')');
                if (json_data.msg) {
                    layermsg(json_data.msg, json_data.tm, function () { if (json_data.url) { location.href = json_data.url; } });
                } else if (json_data.url) {
                    location.href = json_data.url;
                }
            });
        }
    }
    return false;
} 
