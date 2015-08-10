<?php
function smarty_function_readloginhead($paramer,$template){
	global $config,$seo;
	if($_COOKIE['uid']!=""&&$_COOKIE['username']!=""){
        if($_COOKIE['remind_num']>0){
            $html.='<div class="header_Remind header_Remind_hover"> <em class="header_Remind_em "><i class="header_Remind_msg"></i></em><div class="header_Remind_list" style="display:none;">';
            if($_COOKIE['usertype']==1){
                $html.='<div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=msg">邀请面试</a><span class="header_Remind_list_r fr">('.$_COOKIE['userid_msg'].')</span></div><div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=xin">站内信</a><span class="header_Remind_list_r fr">('.$_COOKIE['friend_message1'].')</span></div><div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=sysnews">系统消息</a><span class="header_Remind_list_r fr">('.$_COOKIE['sysmsg1'].')</span></div><div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=commsg">企业回复咨询</a><span class="header_Remind_list_r fr">('.$_COOKIE['usermsg'].')</span></div>';
            }elseif($_COOKIE['usertype']==2){
                $html.='<div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=hr"class="fl">申请职位</a><span class="header_Remind_list_r fr">('.$_COOKIE['userid_job'].')</span></div><div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=xin"class="fl">站内信</a><span class="header_Remind_list_r fr">('.$_COOKIE['friend_message2'].')</span></div><div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=sysnews" class="fl"> 系统消息</a><span class="header_Remind_list_r fr">('.$_COOKIE['sysmsg2'].')</span></div><div class="header_Remind_list_a"><a href="'.$config['sy_weburl'].'/member/index.php?c=msg"class="fl">求职咨询</a><span class="header_Remind_list_r fr">('.$_COOKIE['commsg'].')</span></div>';
            }
            $html.='</div> </div>';
        }
        $html2= "您好：<a href=\"".$config['sy_weburl']."/member\" ><font color=\"red\">".$_COOKIE['username']."</font></a>！<a href=\"javascript:void(0)\" onclick=\"logout('".$config['sy_weburl']."/index.php?c=logout');\">[安全退出]</a>";

        $html.='<div class=" fr">'.$html2.'</div>';
    }else{
        $login_url = Url("login",array(),"1");
        $reg_url = Url("register",array("usertype"=>"1"),"1");
        $reg_com_url = Url("register",array("usertype"=>"2"),"1");			
        $style = $config['sy_weburl']."/app/template/".$config['style'];

        $login='<li><a href="'.$login_url.'">会员登录</a></li>';					
        $user_reg='<li><a href="'.$reg_url.'">个人注册</a></li>';
        $com_reg='<li><a href="'.$reg_com_url.'">企业注册</a></li>';
		$html='<div class=" fr"><div class="yun_topLogin_cont"><div class="yun_topLogin"><a class="yun_More" href="javascript:void(0)">用户登录</a><ul class="yun_Moredown" style="display:none">'.$login.$lt_login.'</ul></div><div class="yun_topLogin"> <a class="yun_More" href="javascript:void(0)">用户注册</a><ul class="yun_Moredown fn-hide" style="display:none">'.$user_reg.$com_reg.$lt_reg.'</ul></div></div></div>';
		if($config['sy_qqlogin']=='1'||$config['sy_sinalogin']=='1'||$config['sy_wxlogin']=='1'){
			$flogin='<div class="fastlogin fr">';
			if($config['sy_qqlogin']=='1'){
				$flogin.='<span style="width:70px;"><img src="'.$config['sy_weburl'].'/app/template/'.$config['style'].'/images/yun_qq.png" class="png" > <a href="'.$config['sy_weburl'].'/qqlogin.php'.'">QQ登录</a></span>';
			}
			if($config['sy_sinalogin']=='1'){
				$flogin.='<span><img src="'.$config['sy_weburl'].'/app/template/'.$config['style'].'/images/yun_sina.png" class="png"> <a href="'.Url("sinaconnect",array(),"1").'">新浪</a></span>';
			} 
			if($config['sy_wxlogin']=='1'){
				$flogin.='<span><img src="'.$config['sy_weburl'].'/app/template/'.$config['style'].'/images/yun_wx.png" class="png"> <a href="'.Url("wxconnect",array(),"1").'">微信</a></span>';
			}  
			$flogin.='</div>';
			$html.=$flogin;
		}
    }
	return $html;
}
?>