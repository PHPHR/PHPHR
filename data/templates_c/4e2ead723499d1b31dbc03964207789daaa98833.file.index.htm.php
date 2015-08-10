<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-07 15:10:13
         compiled from "/home/web/phphr/app/template/default/login/index.htm" */ ?>
<?php /*%%SmartyHeaderCode:177208600655c459d5736a73-10167593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e2ead723499d1b31dbc03964207789daaa98833' => 
    array (
      0 => '/home/web/phphr/app/template/default/login/index.htm',
      1 => 1438912817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177208600655c459d5736a73-10167593',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'keywords' => 0,
    'description' => 0,
    'style' => 0,
    'config' => 0,
    'navmap' => 0,
    'maplist' => 0,
    'ad_37' => 0,
    'loginname' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c459d59413c1_97270760',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c459d59413c1_97270760')) {function content_55c459d59413c1_97270760($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/home/web/phphr/app/include/libs/plugins/function.url.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<META name=keywords content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">
<META name=description content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/style/css.css" type="text/css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/style/login.css" type="text/css">
<!--[if IE 6]>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/png.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
DD_belatedPNG.fix('.png,.login_fast,.login_box_tit .login_cur');
<?php echo '</script'; ?>
>
<![endif]--> 
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
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/slides.jquery.js" type="text/javascript"><?php echo '</script'; ?>
>

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
<div class="login_cont">
<div class="login_w960">
<div class="login_header ">
  <div class="logo fl" style="position:relative"><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_logo'];?>
" class="png"></a></div>
  <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
" class="logo_fh fr">返回网站首页>></a>
</div>

</div>
<div class="clear"></div>
<div class="logoin_banner"> 
	<div id="slides" class="s_lb">
		 <div class="slides_container"> 
		  <?php  $_smarty_tpl->tpl_vars['ad_37'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ad_37']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[37];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 0;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars['ad_37']->key => $_smarty_tpl->tpl_vars['ad_37']->value) {
$_smarty_tpl->tpl_vars['ad_37']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['ad_37']->key;
?>
            <div class="slide"><?php echo $_smarty_tpl->tpl_vars['ad_37']->value['html'];?>
</div>
            <?php } ?> 
		</div> 
	</div>
</div>
<div class="logoin_cont_box">
<div class="logoin_bg"></div>
<div class="login_left ">
  <div class="login_box_cont">
      <div class="login_box_h1_d"  id='usertype1'>会员登录</div>
     <div class="clear"></div>
    <div class="lgoin_box_cot"  id='login_cur'> 
    <div class="login_box_list logoin_re">
      <input type="text" class="login_box_bth placeholder loginname" value="<?php if ($_smarty_tpl->tpl_vars['loginname']->value) {
echo $_smarty_tpl->tpl_vars['loginname']->value;
} else { ?>用户名<?php }?>" name="username" id="username">

      <div class="logoin_msg" style="display:none" id="show_name">
      <div class="logoin_msg_tx" >请填写用户名</div>
      <div class="logoin_msg_icon"></div>
      </div>

    </div>
    <div class="login_box_list logoin_re_m">
      <input type="text" id="password2" class="login_box_bth placeholder loginname loginpwd" value="密码">
	  <input type="password" id="password" name="password" class="login_box_bth placeholder loginname   loginpwd" value="" style="display:none;">
      <div class="logoin_msg" style="display:none" id="show_pass">
      <div class="logoin_msg_tx" >请填写密码</div>
      <div class="logoin_msg_icon"></div>
      </div>
    </div>
    <?php if (strpos($_smarty_tpl->tpl_vars['config']->value['code_web'],"前台登陆")!==false) {?>
    <div class="clear"></div>
    <div class="login_box_list logoin_re_m">
    <input id="txt_CheckCode" type="text" class="login_box_bth_yz loginname  loginpyz" value="验证码" maxlength="4" name="authcode"  >
    </div>
    <div class="login_box_list_yzm"> <img id="vcode_imgs" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/app/include/authcode.inc.php" onclick="check_codes();"></div>
    <?php }?>
    <div class="clear"></div>
    
    <div class="login_box_cz"> <span class="login_box_cz_l">
      <input type="checkbox" name="loginname" value="1" class="index_logoin_check">
      <em class="fl">记住登录状态</em></span> <a href="<?php echo smarty_function_url(array('m'=>'forgetpw'),$_smarty_tpl);?>
">忘记密码？</a> </div>
    <div class="clear"></div>
    <div class="login_box_cz">
      <input type="submit" value="登 录" class="login_box_bth2" onclick="check_login('<?php echo smarty_function_url(array('m'=>'login','c'=>'loginsave'),$_smarty_tpl);?>
');"> </div>

       <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_qqlogin']==1||$_smarty_tpl->tpl_vars['config']->value['sy_sinalogin']==1||$_smarty_tpl->tpl_vars['config']->value['sy_wxlogin']==1) {?>
    <div class="login_other">
      <div class="login_other_left">其他方式登录：</div>
      <div class="login_qq">
      <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_qqlogin']==1) {?>
      <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/qqlogin.php"class="png">QQ登录</a>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_sinalogin']==1) {?>
      <a href="<?php echo smarty_function_url(array('m'=>'sinaconnect'),$_smarty_tpl);?>
" class="log_sina png">新浪微博</a>
      <?php }?>
	   <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_wxlogin']==1) {?>
      <a href="<?php echo smarty_function_url(array('m'=>'wxconnect'),$_smarty_tpl);?>
" class="log_wx png">微信扫一扫</a>
      <?php }?>
	  </div>
    </div>
    <?php }?>
  </div>
 </div>
</div>
<dl class="login_list">
<dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/log_img1.png" class="png"></dt>
<dd>
<div class="login_list_h1">强大的招聘平台</div>
<div class="login_list_p">提供快捷、高效、可靠地网上招聘</div>
</dd>
</dl>
<dl class="login_list">
<dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/log_img2.png" class="png"></dt>
<dd>
<div class="login_list_h1">收获职业机会</div>
<div class="login_list_p">好机会主动找上你，成就职业成功
</div>
</dd>
</dl>
<dl class="login_list">
<dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/log_img3.png" class="png"></dt>
<dd>
<div class="login_list_h1">打造职业形象</div>
<div class="login_list_p">创建职业档案，持续展示自己的优势
</div>
</dd>
</dl>
</div>
</div>

<?php echo '<script'; ?>
>

$(document).ready(function(){
	$("#slides").slides({
		preload: true,
		preloadImage: '<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true
	}); 
	
	$("#username").focus(function(){
		var txAreaVal = $(this).val();
		if( txAreaVal == this.defaultValue){$(this).val("");}
	}).blur(function(){
		var txAreaVal = $(this).val();
		if( txAreaVal == this.defaultValue||$(this).val()==""){$(this).val(this.defaultValue);}
	});
	$("#txt_CheckCode").focus(function(){
		var txAreaVal = $(this).val();
		if( txAreaVal == this.defaultValue){$(this).val("");}
	}).blur(function(){
		var txAreaVal = $(this).val();
		if( txAreaVal == this.defaultValue||$(this).val()==""){$(this).val(this.defaultValue);}
	});
	$("#password2").focus(function(){
		$("#password").show();
		$("#password").focus();
		$("#password2").hide();
	})
	$("#password").blur(function(){
		if($("#password").val()==""){
			$("#password2").show();
			$("#password").hide();
		}
	})
});
        
<?php echo '</script'; ?>
>
<style> 
.icon2 {
    background-image:none;
    background-repeat: no-repeat;
}
.foot{ margin-top:0px;}
#slides { 
    height: 410px;
    position: relative;
}
.slides_container { 
    height: 410px;
    overflow: hidden;
    position: relative;
} 
.slides_container div.slide {
    display: block;
    height: 410px;
}
.slides_container img {
    display: block;
    height: 410px;
}
#slides .prev {
    float: left;
    margin-right: 5px;
}
#slides .next {
    float: left;
    margin-right: 5px;
}
.pagination {
    bottom: 15px;
    list-style: outside none none;
    margin: 6px 0 0;
    position: absolute;
    left: 48%;
    z-index: 9999;
}
.pagination li {
    float: left;
    margin: 0 1px;
}
.pagination li a {
    background-image: url("<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/circle.png");
    background-position: 0 0;
    display: block;
    float: left;
    height: 0;
    overflow: hidden;
    padding-top: 13px;
    width: 13px;
}
.pagination li.current a, .pagination li.current a:hover {
    background-position: -16px 0;
}
.pagination li a:hover {
    background-position: 0 0;
}
#slides a:link, #slides a:visited {
    color: #333;
}
#slides a:hover, #slides a:active {
    color: #9e2020;
}
.index_banner_cont {
    width: 990px;
} 
</style>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tplstyle']->value)."/footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
