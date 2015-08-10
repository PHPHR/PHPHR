<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-07 10:19:30
         compiled from "/home/web/phphr/app/template/admin/admin_comtpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:165682446655c415b2ac8071-18961163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '331522d15d0ee0e026c326e26ef75e75a35c288e' => 
    array (
      0 => '/home/web/phphr/app/template/admin/admin_comtpl.htm',
      1 => 1438912824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165682446655c415b2ac8071-18961163',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'list' => 0,
    'v' => 0,
    'pytoken' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c415b2b3a0b2_24958933',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c415b2b3a0b2_24958933')) {function content_55c415b2b3a0b2_24958933($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK">
<link href="images/reset.css" rel="stylesheet" type="text/css" />
<link href="images/system.css" rel="stylesheet" type="text/css" />
<link href="images/table_form.css" rel="stylesheet" type="text/css" />
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
<title>后台管理</title>
</head>
<body class="body_ifm">
<div class="infoboxp">
<div class="infoboxp_top_bg"></div>
<div class="infoboxp_top">
<span class="admin_title_span">企业模板</span>
<a href="index.php?m=comtpl&c=add" class="admin_infoboxp_tj">添加企业模板</a>

</div>
<div class="table-list">
<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
<div class="" style="float: left; width: 240px;border:1px solid #CCCCCC; text-align: center; padding: 15px; line-height: 180%; margin-top:10px; margin-right:5px; background:#fff">
	  <img width="125" height="125" border="1" alt="<?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
" src="../<?php echo $_smarty_tpl->tpl_vars['v']->value['pic'];?>
">
	  <br>
	 <strong><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</strong>
	 <br>
	风格目录名称：<?php echo $_smarty_tpl->tpl_vars['v']->value['url'];?>

      <br>
      状态：<?php if ($_smarty_tpl->tpl_vars['v']->value['status']==1) {?>正在使用<?php } else { ?>已停止<?php }?>
      <br>
      <input name="" value="修改" type="submit" class="admin_submit4" onClick="location.href='index.php?m=comtpl&c=add&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
'" style="padding:0px;">
      <input name="" value="删除" type="submit" class="admin_submit4" onclick="layer_del('确定要删除？', 'index.php?m=comtpl&c=del&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
');" style="padding:0px;">
	 </div>
     <?php } ?>
</div>
</div>
   <input type="hidden" name="pytoken" id='pytoken' value="<?php echo $_smarty_tpl->tpl_vars['pytoken']->value;?>
">
</body>
</html><?php }} ?>
