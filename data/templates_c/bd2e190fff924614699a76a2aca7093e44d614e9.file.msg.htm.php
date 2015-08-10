<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 17:05:45
         compiled from "/var/www/phphr/app/template/member/msg.htm" */ ?>
<?php /*%%SmartyHeaderCode:174940089355c1d1e9a6a234-61251418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd2e190fff924614699a76a2aca7093e44d614e9' => 
    array (
      0 => '/var/www/phphr/app/template/member/msg.htm',
      1 => 1435755601,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174940089355c1d1e9a6a234-61251418',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'job_arr_msg' => 0,
    'job_arr_url' => 0,
    'job_arr_tm' => 0,
    'job_arr_st' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1d1e9aa2aa6_48955707',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1d1e9aa2aa6_48955707')) {function content_55c1d1e9aa2aa6_48955707($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>提示信息 - <?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webname'];?>
</title>
<META content="<?php echo $_smarty_tpl->tpl_vars['job_arr_msg']->value;?>
" name=Keywords>
<META content="<?php echo $_smarty_tpl->tpl_vars['job_arr_msg']->value;?>
" name=Description>
<link href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/app/template/member/style/msg.css" rel="stylesheet" type="text/css"/>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/jquery-1.8.0.min.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/layer/layer.min.js" language="javascript"><?php echo '</script'; ?>
>
 <SCRIPT>
function TimeOut(){
	<?php if ($_smarty_tpl->tpl_vars['job_arr_url']->value=='1') {?> 
		layer.msg('<?php echo $_smarty_tpl->tpl_vars['job_arr_msg']->value;?>
', <?php echo $_smarty_tpl->tpl_vars['job_arr_tm']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['job_arr_st']->value;?>
,function(){location.href = '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
'});
	<?php } else { ?>
		layer.msg('<?php echo $_smarty_tpl->tpl_vars['job_arr_msg']->value;?>
', <?php echo $_smarty_tpl->tpl_vars['job_arr_tm']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['job_arr_st']->value;?>
,function(){location.href = '<?php echo $_smarty_tpl->tpl_vars['job_arr_url']->value;?>
';});
	<?php }?> 
} 
</SCRIPT>
</head>
<body onLoad="TimeOut()"> 
</body>
</html>
<?php }} ?>
