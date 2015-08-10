<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 15:40:59
         compiled from "/var/www/phphr/app/template/default/register/user.htm" */ ?>
<?php /*%%SmartyHeaderCode:205932450055c1b857825733-20745839%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '777f33ed63074f08fc007aaea2e4b24ea1340c55' => 
    array (
      0 => '/var/www/phphr/app/template/default/register/user.htm',
      1 => 1438760586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205932450055c1b857825733-20745839',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1b8578bd9e1_54513431',
  'variables' => 
  array (
    'title' => 0,
    'keywords' => 0,
    'description' => 0,
    'style' => 0,
    'config' => 0,
    'navmap' => 0,
    'maplist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1b8578bd9e1_54513431')) {function content_55c1b8578bd9e1_54513431($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/var/www/phphr/app/include/libs/plugins/function.url.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<META name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">
<META name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/style/css.css" type="text/css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/style/login.css" type="text/css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/jquery-1.8.0.min.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/layer/layer.min.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/public.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/js/reg_ajax.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>var weburl="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
";<?php echo '</script'; ?>
>
<!--[if IE 6]>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/png.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  DD_belatedPNG.fix('.png,.#bg');
<?php echo '</script'; ?>
>
<![endif]-->
</head>
<body>
<div class="top">
  <div class="top_cot">
    <div class="top_cot_content">
      <div class="top_left fl">
        <div class="yun_welcome fl">欢迎来到<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webname'];?>
！</div>
        <span class="fl"><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/wap" class="wap_icon">手机版</a> | <a href="<?php echo smarty_function_url(array('m'=>'subscribe'),$_smarty_tpl);?>
">订阅</a></span> </div>
      <div class="top_right_re fr">
        <div class="top_right">
          <div class="yun_topNav fr"> <a class="yun_navMore" href="javascript:;">网站导航</a>
            <div class="yun_webMoredown" style="display:none">
              <div class="yun_top_nav_box"> <?php  $_smarty_tpl->tpl_vars['navmap'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['navmap']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
global $db,$db_config,$config;eval('$paramer=array("key"=>"\'key\'","item"=>"\'navmap\'","nocache"=>"")
;');
		include(PLUS_PATH."/navmap.cache.php");$Navlist=array();
		if(is_array($navmap)){
			$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
			$paramer = $ParamerArr[arr];
			$Purl =  $ParamerArr[purl];
		}
		$Navlist =$navmap[0];
		if(is_array($navmap)){
			foreach($navmap as $k=>$v){
				foreach($Navlist as $key=>$val){
					if($k==$val[id]){
						foreach($v as $kk=>$value){
							if($value[type]=='1'){
								if($config[sy_seo_rewrite]=="1" && $value[furl]!=''){
									$v[$kk][url] = $config[sy_weburl]."/".$value[furl];
								}else{
									$v[$kk][url] = $config[sy_weburl]."/".$value[url];
								}
							}
						}
						$Navlist[$key]['list']=$v;
					}
				}
			}
			foreach($Navlist as $key=>$value){
				if($value[type]=='1'){
					if($config[sy_seo_rewrite]=="1" && $value[furl]!=''){
						$Navlist[$key][url] = $config[sy_weburl]."/".$value[furl];
					}else{
						$Navlist[$key][url] = $config[sy_weburl]."/".$value[url];
					}
				}
			}
		}$Navlist = $Navlist; if (!is_array($Navlist) && !is_object($Navlist)) { settype($Navlist, 'array');}
foreach ($Navlist as $_smarty_tpl->tpl_vars['navmap']->key => $_smarty_tpl->tpl_vars['navmap']->value) {
$_smarty_tpl->tpl_vars['navmap']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['navmap']->key;
?>
                <div class="yun_top_nav_h1"><a href="<?php echo $_smarty_tpl->tpl_vars['navmap']->value['url'];?>
" <?php if ($_smarty_tpl->tpl_vars['navmap']->value['eject']) {?> target="_blank"<?php }?>><?php echo $_smarty_tpl->tpl_vars['navmap']->value['name'];?>
</a></div>
                <ul>
                  <?php  $_smarty_tpl->tpl_vars['maplist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['maplist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['navmap']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['maplist']->key => $_smarty_tpl->tpl_vars['maplist']->value) {
$_smarty_tpl->tpl_vars['maplist']->_loop = true;
?>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['maplist']->value['url'];?>
" <?php if ($_smarty_tpl->tpl_vars['maplist']->value['eject']) {?> target="_blank"<?php }?>><?php echo $_smarty_tpl->tpl_vars['maplist']->value['name'];?>
</a></li>
                  <?php } ?>
                </ul>
                <?php } ?> </div>
            </div>
          </div>
          <SCRIPT LANGUAGE='JavaScript' src='<?php echo smarty_function_url(array('m'=>'ajax','c'=>'RedLoginHead'),$_smarty_tpl);?>
'></SCRIPT>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="register_header">
  <div class="reg_w980">
    <div class="reg_logo"><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_member_logo'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webname'];?>
" class="png"></a></div>
    <div class="reg_msg">求职者注册</div>
  </div>
</div>
<!--content  start-->
<div class="reg_content" >
  <div class="logoin_cont fl">
    <div class="reg_h1_tit">
      <ul class="reg_ul_list">
        <li onclick="checkreg(1)" id="reg1" class="reg_cur"><a class="reg_h1_icon"><i class="reg_h1_icon_i reg_h1_icon_i3 png"></i>用户注册</a></li>
		<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_fast']=='1') {?>
        <li onclick="checkreg(2)" id="reg2"><a class="reg_h1_icon"><i class="reg_h1_icon_i reg_h1_icon_i1 png"></i>快速注册</a></li>
		<?php }?>
      </ul>
    </div>

    <div class="register_left">
	<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_fast']=='1') {?>
    <div class="register_Switching_box" id="regtype2" style="display:none">
       <div class="reg_fast_cont"> 
       <div class="reg_fast reg_fast_cur" onclick="checkreg(2)">手机注册</div>  
       <div class="reg_fast" onclick="checkreg(3)">邮箱注册</div>  
     </div>
       <ul class="register_list">
     <li class="mt20"><em><font color="#FF0000">*</font> 手机号码：</em>
     <input type="text" class="logoin_text tips_class" id="moblie" onBlur="reg_checkAjax('moblie');">
     <span class="reg_tips reg_tips_red" id="ajax_moblie" style="display:none;"></span>
     </li>
     <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_msg_regcode']=="1") {?>
     <li class="mt20"><em><font color="#FF0000">*</font> 短信验证：</em>
     <span style="float:left"><input type="text" id="moblie_code" class="logoin_text_yz" onBlur="reg_checkAjax('moblie_code');">
     <a class="reg_btn_s02_disable" href="javascript:sendmsg();"><span id="time">获取短信验证</span></a></span>
     <span class="reg_tips reg_tips_red" id="ajax_moblie_code" style="display:none;"></span>
     </li> 
     <?php }?>
     <li class="mt20"><em><font color="#FF0000">*</font> 密&nbsp;&nbsp;码：</em> 
     <span id="pass2"><input type="password" onkeyup="uppassword(2)" id="password2" onBlur="reg_checkAjax('password2');" class="logoin_text tips_class" value=""></span>
     <span class="reg_tips reg_tips_red" id="ajax_password2" style="display:none;"></span>
     </li>
     <li><em>&nbsp;</em>
       <div class="kg_lgn_psw_strong">
       <div class="kg_lgn_psw_txt">密码强度:弱</div>
         <div class="kg_lgn_psw_strong_cnt"> 
         <span id="pass1_2" class="psw_span"></span> 
         <span id="pass2_2" class="psw_span "></span> 
         <span id="pass3_2" class="psw_span "></span> 
        </div>        
        <div class="kg_lgn_psw_txt">强</div>
        <div class="psw_xs" onmousemove="showtip(2)" onmouseout="hidetip(2)">
        <a href="javascript:showpw(2);" id="showpw2" class="psw_xs_a">显示密码</a> 
        <i class="psw_xs_icon"></i>
        <div class="psw_xs_tips" id="tip2" style="display:none;">你可以点击这里检查已填写的密码</div></div>
          </div>
        </li>
		<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_passconfirm']=='1') {?>
		<li class="mt10"><em><font color="#FF0000">*</font> 确认密码：</em> 
			 <span id="pass1"><input type="password" id="passconfirm2" onBlur="reg_checkAjax('passconfirm2');" class="logoin_text tips_class" value=""></span>
			 <span class="reg_tips reg_tips_red" id="ajax_passconfirm2" style="display:none;"></span>
	    </li>
		<?php }?>

        <?php if (strpos($_smarty_tpl->tpl_vars['config']->value['code_web'],"注册会员")!==false) {?>
         <li class="m10"><em><font color="#FF0000">*</font> 验证码：</em>
          <input id="CheckCode2" type="text" class="logoin_text_yz"  maxlength="4">
          <img id="vcode_img" class="authcode" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/app/include/authcode.inc.php"><span class="reg_yz_look">看不清？ 
          <a href="javascript:check_code();" class="registe_a">换一张</a></span>
          </li>
        <?php }?>
       <li class="m10">
        <em>&nbsp;</em><input type="checkbox" id="xieyi2" class="logoin_check" value="1">
        <label for="isReadagreement">我已阅读<a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/about/service.html" target="_blank" class="reg_yhxy"> 《用户服务协议》</a> ，并自愿遵守该协议。
        </li>
         <li class="mt20"><em>&nbsp;</em><input type="button" class="register_submit" onclick="check_user(2);"></li>
     </ul>
    </div>
    
    <div class="register_Switching_box" id="regtype3" style="display:none">
    <div class="reg_fast_cont"> 
       <div class="reg_fast" onclick="checkreg(2)">手机注册</div>  
       <div class="reg_fast reg_fast_cur" onclick="checkreg(3)">邮箱注册</div>  
     </div>
      <ul class="register_list">
        <li class="mt20 reg_re"><em><font color="#FF0000">*</font> 邮&nbsp;&nbsp;箱：</em>
        <input type="text" class="logoin_text tips_class" id="email3" onBlur="reg_checkAjax('email3');" onkeyup="get_def_email(this.value,'3');">
         <div class="reg_email_box" id="defemail3" style="display:none"></div>
		 <span class="reg_tips reg_tips_red" id="ajax_email3" style="display:none;"></span>
        </li>
     <li class="mt20"><em><font color="#FF0000">*</font> 密&nbsp;&nbsp;码：</em> 
     <span id="pass3"><input type="password" onkeyup="uppassword(3)" id="password3" onBlur="reg_checkAjax('password3');" class="logoin_text tips_class" value=""></span>
     <span class="reg_tips reg_tips_red" id="ajax_password3" style="display:none;"></span>
     </li>
     <li><em>&nbsp;</em>
       <div class="kg_lgn_psw_strong">
       <div class="kg_lgn_psw_txt">密码强度:弱</div>
         <div class="kg_lgn_psw_strong_cnt"> 
         <span id="pass1_3" class="psw_span"></span> 
         <span id="pass2_3" class="psw_span "></span> 
         <span id="pass3_3" class="psw_span "></span> 
        </div>        
        <div class="kg_lgn_psw_txt">强</div>
        <div class="psw_xs" onmousemove="showtip(3)" onmouseout="hidetip(3)">
        <a href="javascript:showpw(3);" id="showpw3" class="psw_xs_a">显示密码</a> 
        <i class="psw_xs_icon"></i>
        <div class="psw_xs_tips" id="tip3" style="display:none;">你可以点击这里检查已填写的密码</div></div>
          </div>
        </li>
		<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_passconfirm']=='1') {?>
		<li class="mt10"><em><font color="#FF0000">*</font> 确认密码：</em> 
			 <span id="pass1"><input type="password" id="passconfirm3" onBlur="reg_checkAjax('passconfirm3');" class="logoin_text tips_class" value=""></span>
			 <span class="reg_tips reg_tips_red" id="ajax_passconfirm3" style="display:none;"></span>
	    </li>
		<?php }?>
        <?php if (strpos($_smarty_tpl->tpl_vars['config']->value['code_web'],"注册会员")!==false) {?>
         <li class="m10"><em><font color="#FF0000">*</font> 验证码：</em>
          <input id="CheckCode3" type="text" class="logoin_text_yz"  maxlength="4">
          <img id="vcodeimg" class="authcode" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/app/include/authcode.inc.php"><span class="reg_yz_look">看不清？ 
          <a href="javascript:checkcode();" class="registe_a">换一张</a></span>
          </li>
        <?php }?>
       <li class="m10">
        <em>&nbsp;</em><input type="checkbox" id="xieyi3" class="logoin_check" value="1">
        <label for="isReadagreement">我已阅读<a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/about/service.html" target="_blank" class="reg_yhxy"> 《用户服务协议》</a> ，并自愿遵守该协议。
        </li>
         <li class="mt20"><em>&nbsp;</em><input type="button" class="register_submit" onclick="check_user(3);"></li>
     </ul>
     </div>
     
     <?php }?>

     <div class="register_Switching_box" id="regtype1">
     <ul class="register_list">
     <li class="mt20"><em><font color="#FF0000">*</font> 用户名：</em>
     <input type="text" id="username1" class="logoin_text tips_class" onBlur="reg_checkAjax('username1');">
     <span class="reg_tips reg_tips_red" id="ajax_username1" style="display:none;"></span>
     </li>
     <li class="mt20"><em><font color="#FF0000">*</font> 密&nbsp;&nbsp;码：</em> 
     <span id="pass1"><input type="password" onkeyup="uppassword(1)" id="password1" onBlur="reg_checkAjax('password1');" class="logoin_text tips_class" value=""></span>
     <span class="reg_tips reg_tips_red" id="ajax_password1" style="display:none;"></span>
     </li>
     <li class="reg_re"><em>&nbsp;</em>
       <div class="kg_lgn_psw_strong">
       <div class="kg_lgn_psw_txt">密码强度:弱</div>
         <div class="kg_lgn_psw_strong_cnt"> 
         <span id="pass1_1" class="psw_span"></span> 
         <span id="pass2_1" class="psw_span "></span> 
         <span id="pass3_1" class="psw_span "></span> 
        </div>
        <div class="kg_lgn_psw_txt">强</div>
        <div class="psw_xs" onmousemove="showtip(1)" onmouseout="hidetip(1)">
        <a href="javascript:showpw(1);" id="showpw1" class="psw_xs_a">显示密码</a> 
        <i class="psw_xs_icon"></i>
        <div class="psw_xs_tips" id="tip1" style="display:none;">你可以点击这里检查已填写的密码</div></div>
          </div>
        </li>
		<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_passconfirm']=='1') {?>
		<li class="mt20"><em><font color="#FF0000">*</font> 确认密码：</em>
			 <span id="pass1"><input type="password" id="passconfirm1" onBlur="reg_checkAjax('passconfirm1');" class="logoin_text tips_class" value=""></span>
			 <span class="reg_tips reg_tips_red" id="ajax_passconfirm1" style="display:none;"></span>
	    </li>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_username']=='1') {?>
		 <li class="mt20 reg_re2"><em><font color="#FF0000">*</font> 真实姓名：</em>
        <input type="text" class="logoin_text tips_class" id="name" onBlur="reg_checkAjax('name');" >
		 <span class="reg_tips reg_tips_red" id="ajax_name" style="display:none;"></span>
        </li>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_useremail']=='1') {?>
        <li class="mt20 reg_re2"><em><font color="#FF0000">*</font> 邮&nbsp;&nbsp;箱：</em>
        <input type="text" class="logoin_text tips_class" id="email1" onBlur="reg_checkAjax('email1');" onkeyup="get_def_email(this.value,'1');">
         <div class="reg_email_box" id="defemail1" style="display:none"></div>
		 <span class="reg_tips reg_tips_red" id="ajax_email1" style="display:none;"></span>
        </li>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['config']->value['reg_usertel']=='1') {?>
		 <li class="mt20"><em><font color="#FF0000">*</font> 手&nbsp;&nbsp;机：</em>
        <input type="text" class="logoin_text tips_class" id="usertel" onBlur="reg_checkAjax('usertel');" >
		 <span class="reg_tips reg_tips_red" id="ajax_usertel" style="display:none;"></span>
        </li>
		<?php }?>

        <?php if (strpos($_smarty_tpl->tpl_vars['config']->value['code_web'],"注册会员")!==false) {?>
         <li class="m10"><em><font color="#FF0000">*</font> 验证码：</em>
          <input id="CheckCode1" type="text" class="logoin_text_yz"  maxlength="4">
          <img id="vcode_imgs" class="authcode" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/app/include/authcode.inc.php"><span class="reg_yz_look">看不清？ 
          <a href="javascript:check_codes();" class="registe_a">换一张</a></span>
          </li>
        <?php }?>
       <li class="m10">
        <em>&nbsp;</em><input type="checkbox" id="xieyi1" class="logoin_check" value="1">
        我已阅读<a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/about/service.html" target="_blank" class="reg_yhxy"> 《用户服务协议》</a> ，并自愿遵守该协议。
        </li>
         <li class="mt20"><em>&nbsp;</em><input type="button" class="register_submit" onclick="check_user('1');"></li>
     </ul>
    </div>
        <?php if (strpos($_smarty_tpl->tpl_vars['config']->value['code_web'],"注册会员")!==false) {?>
        <input type="hidden" id="code" value="1" />
        <?php } else { ?>
        <input type="hidden" id="code" value="0" />
        <?php }?>
      <input type="hidden" id="default" value="-1" />
      <input type="hidden" id="def" value="" />
      <input type="hidden" id="event" value="" />
      <input type="hidden" id="allnum" value="0" />
      <input type="hidden" id="send" value="0" />
      <input type="hidden" id="usertype" value="1" />
        </div>
    <div class="register_right">
      <div class="register_right_c"> 已有个人账号 ? <a href="<?php echo smarty_function_url(array('m'=>'login','usertype'=>1),$_smarty_tpl);?>
">立即登录</a></div>
      <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_qqlogin']==1||$_smarty_tpl->tpl_vars['config']->value['sy_sinalogin']==1) {?>
      <div class="register_right_c">使用合作网站账号登录 </div>
      <div class="register_right_q">
        <div class="login_qq" style="width:180px; padding-top:0px;"> <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_qqlogin']==1) {?> <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/qqlogin.php" style="color:#333;">QQ登录</a> <?php }?> <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_qqlogin']==1&&$_smarty_tpl->tpl_vars['config']->value['sy_sinalogin']==1) {?>|<?php }?>
          <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_sinalogin']==1) {?> <a href="<?php echo smarty_function_url(array('m'=>'sinaconnect'),$_smarty_tpl);?>
"class="log_sina" style="color:#333;">新浪微博</a> <?php }?> </div>
      </div>
      <?php }?> </div>
  </div>
</div>
<style>
.icon2 {background-image:none;background-repeat: no-repeat;}
</style>
<!--content  end--> 
<div class="clear"></div>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tplstyle']->value)."/footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
