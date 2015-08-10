<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 15:23:28
         compiled from "/var/www/phphr/app/template/admin/admin_list_seo.htm" */ ?>
<?php /*%%SmartyHeaderCode:76716489355c1b9f0741764-17457160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a489ac4ad039239a68819ac5b7378687bc2115aa' => 
    array (
      0 => '/var/www/phphr/app/template/admin/admin_list_seo.htm',
      1 => 1434528047,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '76716489355c1b9f0741764-17457160',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'arr_data' => 0,
    'key' => 0,
    'row' => 0,
    'pytoken' => 0,
    'seolist' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1b9f07dbc31_10095886',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1b9f07dbc31_10095886')) {function content_55c1b9f07dbc31_10095886($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/phphr/app/include/libs/plugins/modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
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
<?php echo '<script'; ?>
> 
function check_type(id,value){
	var val = value=="1"?"0":"1";
	var pytoken=$("#pytoken").val();
	$.post("index.php?m=advertise&c=ajax_check",{id:id,val:val,pytoken:pytoken},function(data){
		html = "<a href=\"javascript:void(0);\" onClick=\"check_type("+id+","+val+");\" >"+data+"</a>";
		$("#"+id).html(html);
	});
}
<?php echo '</script'; ?>
>
<title>后台管理</title>
</head>

<body class="body_ifm">
<div class="infoboxp">
<div class="infoboxp_top_bg"></div>
<div class="main_tag">
<div class="admin_h1_bg"> 
 <span class="infoboxp_top_span">SEO管理</span>
 <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_data']->value['seomodel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['row']->key;
?>   
    <span class="infoboxp_top_span_sz  <?php if ($_GET['action']==$_smarty_tpl->tpl_vars['key']->value||($_GET['action']==''&&$_smarty_tpl->tpl_vars['key']->value=='index')) {?>infoboxp_top_span_sz_in <?php }?>">
    <a href="index.php?m=seo&action=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value;?>
</a></span>
    <?php } ?>
    <a href="index.php?m=seo&c=SeoAdd" class="admin_infoboxp_tj" style="margin-top:0px;float:none;">添加SEO</a> 
</div>



</div>

<div class="table-list">

<div class="admin_table_border" style="float:left">
<iframe id="supportiframe"  name="supportiframe" onload="returnmessage('supportiframe');" style="display:none"></iframe>
<form action="index.php" name="myform" method="get" id='myform' target="supportiframe">
<input type="hidden" name="m" value="seo">
<input type="hidden" name="c" value="del">
<input type="hidden" name="pytoken" id='pytoken'  value="<?php echo $_smarty_tpl->tpl_vars['pytoken']->value;?>
">
<table width="100%">
	<thead>
		<tr class="admin_table_top">
        	<th><label for="chkall"><input type="checkbox" id='chkAll' onclick='CheckAll(this.form)' /></label></th>
			<th align="left" width="200">名称</th>
            <th align="left">SEO标识符</th>
            <th align="left">网页标题</th>
            <th align="left">更新时间</th>
			<th align="center" class="admin_table_th_bg">操作</th>
		</tr>
	</thead>
	<tbody>
    <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['seolist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['list']->key;
?>
    <tr align="left" <?php if (($_smarty_tpl->tpl_vars['key']->value+1)%2=='0') {?>class="admin_com_td_bg"<?php }?> id="list<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
    	<td align="center"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" name='del[]' onclick='unselectall()' rel="del_chk" /></td>
    	<td align="left" class="td1"><span><?php echo $_smarty_tpl->tpl_vars['list']->value['seoname'];?>
</span></td> 
        <td align="left" class="ud"><?php echo $_smarty_tpl->tpl_vars['list']->value['ident'];?>
</td>
        <td width="450px" align="left" class="ud"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</td>
        <td width="150px" class="ud" align="left"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value['time'],"%Y-%m-%d");?>
</td>
    	<td width="70px" align="center"> <a href="index.php?m=seo&c=Modify&id=<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" class="admin_cz_sc">修改</a> | 
        <a href="javascript:;" onClick="layer_del('确定要删除？','index.php?m=seo&c=del&del=<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
');" class="admin_cz_sc">删除</a></td>
  	</tr>
  <?php } ?>
  
  </tbody>
  </table>
</form>
</div>
</div>
</div>
<style>
.infoboxp_top_span_sz_in{
background: #666;
font-weight: bold;
color: #fff;
border: none;
border-radius: 3px;
}
.infoboxp_top_span_sz_in a{color:#fff}
</style>
</body>
</html><?php }} ?>
