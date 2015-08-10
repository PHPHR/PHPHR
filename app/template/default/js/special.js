/*
*公用报名方法
*/ 
 
function comapply(id,integral,url){
	if(integral){
		layer.confirm("参加专题招聘，将扣除您"+integral+pricename+"，审核不通过将退还，是否继续？", function(){
			$.post(url,{id:id},function(data){
				var data=eval('('+data+')');
				if(data.url=='1'){
					parent.layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.reload();});return false;
				}else{
					parent.layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.href=data.url;});return false;
				}
			});
		}); 
	}else{
		$.post(url,{id:id},function(msg){
			var data=eval('('+data+')');
			if(data.url=='1'){
				parent.layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.reload();});return false;
			}else{
				parent.layer.msg(data.msg, Number(data.tm), Number(data.st),function(){location.href=data.url;});return false;
			}
		});
	}
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
 
$(document).ready(function(){
	$(".header_fixed_login_after").hover(function(){
		$(".header_fixed_reg_box").show();
	},function(){
		$(".header_fixed_reg_box").hide();
	}); 
});