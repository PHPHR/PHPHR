<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-07 10:18:28
         compiled from "/home/web/phphr/app/template/admin/admin_evaluate_list.htm" */ ?>
<?php /*%%SmartyHeaderCode:17035797255c41574244270-48794038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da1db4ca13fe85d9a85363b562a80d33135773e8' => 
    array (
      0 => '/home/web/phphr/app/template/admin/admin_evaluate_list.htm',
      1 => 1438912823,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17035797255c41574244270-48794038',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'rows' => 0,
    'key' => 0,
    'v' => 0,
    'arr' => 0,
    'pagenav' => 0,
    'pytoken' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c41574336548_92606583',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c41574336548_92606583')) {function content_55c41574336548_92606583($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/home/web/phphr/app/include/libs/plugins/function.url.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/web/phphr/app/include/libs/plugins/modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
<title>��̨����</title>
</head>
<body class="body_ifm">
<div class="infoboxp">
  <div class="infoboxp_top_bg"></div>
  <div class="admin_Filter"> 
	<span class="complay_top_span fl">�����Ծ��б�</span> 
    <!--�߼�������-->
    <form action="index.php" name="myform" method="get" >
      <input name="m" value="admin_evaluate" type="hidden"/> 
      <input class="admin_Filter_search"  type="text" name="keyword"  size="25" style=" float:left">
      <input class="admin_Filter_bth"  type="submit" name="evaluate_search" value="����"/>
    </form>
	<span class='admin_search_div'>
		<div class="admin_adv_search"><div class="admin_adv_search_bth">�߼�����</div></div>  
	</span>
    <a href="index.php?m=admin_evaluate&c=examup" class="admin_infoboxp_nav admin_infoboxp_tj">��Ӳ����Ծ�</a><em class="admin-tit_line"></em> 
	<a href="index.php?m=admin_evaluate&c=group" class="admin_infoboxp_nav admin_infoboxp_gl">����������</a> 
	
	</div>
  
  <?php echo $_smarty_tpl->getSubTemplate ("admin/admin_search.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  <div class="table-list">
    <div class="admin_table_border">
      <iframe id="supportiframe"  name="supportiframe" onload="returnmessage('supportiframe');" style="display:none"></iframe>
      <form action="index.php" target="supportiframe" name="myform" method="get" id='myform'>
        <input name="m" value="admin_evaluate" type="hidden"/>
        <input name="c" value="delevaluate" type="hidden"/>
        <table width="100%">
          <thead>
            <tr class="admin_table_top">
              <th style="width:20px;"><label for="chkall">
                  <input type="checkbox" id='chkAll'  onclick='CheckAll(this.form)'/>
                </label></th>
              <th width="70"> <?php if ($_GET['t']=="id"&&$_GET['order']=="asc") {?> <a href="index.php?m=admin_evaluate&order=desc&t=id">���<img src="images/sanj.jpg"/></a> <?php } else { ?> <a href="index.php?m=admin_evaluate&order=asc&t=id">���<img src="images/sanj2.jpg"/></a> <?php }?> </th>
              <th width="130" align="left">�������</th>
              <th width="350" align="left">�Ծ����</th>
              <th> <?php if ($_GET['t']=="ctime"&&$_GET['order']=="asc") {?> <a href="index.php?m=admin_evaluate&order=desc&t=ctime">����ʱ��<img src="images/sanj.jpg"/></a> <?php } else { ?> <a href="index.php?m=admin_evaluate&order=asc&t=ctime">����ʱ��<img src="images/sanj2.jpg"/></a> <?php }?> </th>
              <th width="60"> <?php if ($_GET['t']=="sort"&&$_GET['order']=="asc") {?> <a href="index.php?m=admin_evaluate&order=desc&t=sort">����<img src="images/sanj.jpg"/></a> <?php } else { ?> <a href="index.php?m=admin_evaluate&order=asc&t=sort">����<img src="images/sanj2.jpg"/></a> <?php }?> </th>
              <th  class="admin_table_th_bg">����</th>
            </tr>
          </thead>
          <tbody>
          
          <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
          <tr align="center"<?php if (($_smarty_tpl->tpl_vars['key']->value+1)%2=='0') {?>class="admin_com_td_bg"<?php }?> id="list<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">
            <td><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"  name='del[]' onclick='unselectall()' rel="del_chk" /></td>
            <!--���-->
            <td align="left" class="td1" style="text-align:center;" width="70"><span><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</span></td>
            <!--�������-->
            <td class="ud" align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value[$_smarty_tpl->tpl_vars['v']->value['keyid']];?>
</td>
            <!--�Ծ����-->
            <td class="od" align="left"><a href="<?php echo smarty_function_url(array('m'=>'evaluate','c'=>'exampaper','titleid'=>$_smarty_tpl->tpl_vars['v']->value['id'],'gid'=>$_smarty_tpl->tpl_vars['v']->value['keyid']),$_smarty_tpl);?>
" target="_blank" class="admin_cz_sc"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a></td>
            <!--����ʱ��-->
            <td class="td"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['ctime'],"%Y-%m-%d");?>
 </td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['sort'];?>
</td>
            <td><a href="?m=admin_evaluate&c=examup&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="admin_cz_bj">�޸�</a> | <a href="javascript:void(0)" onClick="layer_del('ȷ��Ҫɾ����','index.php?m=admin_evaluate&c=delevaluate&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
');"class="admin_cz_sc">ɾ��</a></td>
          </tr>
          <?php } ?>
          
            <td align="center"><input type="checkbox" id='chkAll2' onclick='CheckAll2(this.form)' /></td>
            <td colspan="3"><label for="chkAll2">ȫѡ</label>
              &nbsp;
              <input class="admin_submit4"  type="button" name="delsub" value="ɾ����ѡ" onClick="return really('del[]')" />
            <td colspan="6" class="digg"><?php echo $_smarty_tpl->tpl_vars['pagenav']->value;?>
</td>
          </tr>
            </tbody>
          
        </table>
        <input type="hidden" name="pytoken" id='pytoken' value="<?php echo $_smarty_tpl->tpl_vars['pytoken']->value;?>
">
      </form>
    </div>
  </div>
</div>
</body>
</html>
<?php }} ?>
