<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-07 10:09:57
         compiled from "/home/web/phphr/app/template/admin/login.htm" */ ?>
<?php /*%%SmartyHeaderCode:160202259455c41375ef57b0-50064873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '09642048e58d903659c23a7643310ebaf4e224da' => 
    array (
      0 => '/home/web/phphr/app/template/admin/login.htm',
      1 => 1438912823,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160202259455c41375ef57b0-50064873',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'pytoken' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c413760c24e5_16480703',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c413760c24e5_16480703')) {function content_55c413760c24e5_16480703($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="images/admin.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=GBK">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/jquery-1.8.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/layer/layer.min.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/admin_public.js" language="javascript"><?php echo '</script'; ?>
>
<title><?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webname'];?>
 - 后台管理中心</title>
</head>
<body>
<div class="admin_logo_bg">
<div class="logoin_top"></div>
<div class="logoin_cont">
<div class="login_box">
<div class="logoin_c">
<div class="logoin_logo"><img src="images/logoin_logo.png"></div>
<div class="logoin_title"><div class=""><img src="images/logo_t.png"></div></div>
	<div class="login_iptbox">
	<iframe id="supportiframe"  name="supportiframe" onload="returnmessage('supportiframe');" style="display:none"></iframe>
	<form action="" method="post" target="supportiframe">
    <ul class="logoin_list">
		<li><span><label for="username">用户名：</label></span><input type="text" class="ipt" size="10" name="username" value="" /></li>
		<li><span><label for="password">密&nbsp; 码：</label></span><input type="password" class="ipt" name="password" value="" /></li>
       
       <?php if (stripos($_smarty_tpl->tpl_vars['config']->value['code_web'],"后台登陆")) {?>
       <li>
		<span><label for="code">验证码：</label></span><input type="text" id="ipt_code" class="ipt_code" name="authcode" value="" />
        <img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/app/include/authcode.inc.php" align="absmiddle" >
        </li>
        <?php }?>
        
		<li><span>&nbsp;</span><input type="submit" class="admin_login_sub" name="login_sub" value="登录" /><input type="reset" class="admin_login_sub admin_login_sub1" name="login_sub" value="重置" /></li>
      </ul>
	  <input type="hidden" name="pytoken" value="<?php echo $_smarty_tpl->tpl_vars['pytoken']->value;?>
">
	</form>
	</div>
</div>
</div>
</div>
</div>
</body>
</html><?php }} ?>
