<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 17:06:16
         compiled from "/var/www/phphr//app/template/member/user/header.htm" */ ?>
<?php /*%%SmartyHeaderCode:198457491755c1d208cf29d2-97589762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0286cc898aba458cb6d16180be99607c6cd821a6' => 
    array (
      0 => '/var/www/phphr//app/template/member/user/header.htm',
      1 => 1435755611,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198457491755c1d208cf29d2-97589762',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'user_style' => 0,
    'navmap' => 0,
    'maplist' => 0,
    'cookie' => 0,
    'username' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1d208d33ce4_88595853',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1d208d33ce4_88595853')) {function content_55c1d208d33ce4_88595853($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>个人用户管理平台 - <?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webname'];?>
</title>
    <meta http-equiv=Content-Type content="text/html; charset=GBK">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/jquery-1.8.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/setday.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/member_public.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/public.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/layer/layer.min.js"><?php echo '</script'; ?>
>
    <link href="<?php echo $_smarty_tpl->tpl_vars['user_style']->value;?>
/images/m_css.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['user_style']->value;?>
/images/m_header.css" type="text/css" rel="stylesheet">
    <!--[if IE 6]>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/png.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
      DD_belatedPNG.fix('.png');
    <?php echo '</script'; ?>
>
    <![endif]-->
    <meta content="MSHTML 6.00.6000.16939" name="Generator">
</head>
<body>
    <?php echo '<script'; ?>
>var weburl = "<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
";<?php echo '</script'; ?>
>
    <div class="header">
        <div class="w950">
            <div class="logo  fltL">
                <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
" target="_blank" title='返回网站首页'>
                <img alt="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webname'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_member_logo'];?>
" >
                </a>
            </div>
            <div class="top_right_re fltR">
                <div class="top_right">
                    <div class="yun_topNav fr">
                        <a class="yun_navMore png" href="javascript:void(0)">网站导航</a>
                        <div class="yun_webMoredown" style="display:none">
                            <div class="yun_top_nav_box">
                                <?php  $_smarty_tpl->tpl_vars['navmap'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['navmap']->_loop = false;
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
                                <div class="yun_top_nav_h1">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['navmap']->value['url'];?>
" <?php if ($_smarty_tpl->tpl_vars['navmap']->value['eject']) {?> target="_blank"<?php }?>><?php echo $_smarty_tpl->tpl_vars['navmap']->value['name'];?>
</a>
                                </div>
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
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['cookie']->value['remind_num']>0) {?>
                    <div class="header_Remind fr header_Remind_hover" style=" margin-top:13px;">
                        <em class="header_Remind_em "><i class="header_Remind_msg"></i></em>
                        <div class="header_Remind_list" style="display:none;">
                            <div class="header_Remind_list_a">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/member/index.php?c=msg" class="fl">邀请面试</a>
                                <span class="header_Remind_list_r fr">(<?php echo $_smarty_tpl->tpl_vars['cookie']->value['userid_msg'];?>
)</span>
                            </div>
                            <div class="header_Remind_list_a">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/member/index.php?c=xin" class="fl">站内信</a>
                                <span class="header_Remind_list_r fr">(<?php echo $_smarty_tpl->tpl_vars['cookie']->value['friend_message1'];?>
)</span>
                            </div>
                            <div class="header_Remind_list_a">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/member/index.php?c=sysnews" class="fl">系统消息 </a>
                                <span class="header_Remind_list_r fr">(<?php echo $_smarty_tpl->tpl_vars['cookie']->value['sysmsg1'];?>
)</span>
                            </div>
                            <div class="header_Remind_list_a">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/member/index.php?c=commsg" class="fl">企业回复咨询</a>
                                <span class="header_Remind_list_r fr">(<?php echo $_smarty_tpl->tpl_vars['cookie']->value['usermsg'];?>
)</span>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="header_seach_State fltR">
                        <span class="header_seach_State_name">你好！<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</span>
                        <span class="user_m_line">|</span>
                        <a href="javascript:void(0)" onClick="logout('index.php?act=logout')" class="header_seach_State_a">退出</a>
                        <span class="user_m_line">|</span>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
" target="_blank" title='返回网站首页' class="user_m_fanh">返回网站首页</a>
                        <span class="user_m_line">|</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div><?php }} ?>
