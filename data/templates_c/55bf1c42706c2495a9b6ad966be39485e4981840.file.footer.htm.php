<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 17:06:16
         compiled from "/var/www/phphr//app/template/member/user/footer.htm" */ ?>
<?php /*%%SmartyHeaderCode:145791397355c1d208d62db9-45773849%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55bf1c42706c2495a9b6ad966be39485e4981840' => 
    array (
      0 => '/var/www/phphr//app/template/member/user/footer.htm',
      1 => 1434686186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145791397355c1d208d62db9-45773849',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'statis' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1d208d82f25_97493656',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1d208d82f25_97493656')) {function content_55c1d208d82f25_97493656($_smarty_tpl) {?>

<!--简历置顶-->
<div id="resumetop" style="display:none; width: 400px;">
    <div class="admin_Operating_sh" style="padding:10px; ">
        <div class="admin_Operating_sh_h1">
            <div class="user_Audit_box" style="margin-top:0;line-height:20px;padding:5px 10px 5px 10px;color:#000;">让企业第一眼就发现您；自由选择置顶天数，<?php echo $_smarty_tpl->tpl_vars['config']->value['integral_resume_top'];
echo $_smarty_tpl->tpl_vars['config']->value['integral_pricename'];?>
/天。
            <br />您当前可用<?php echo $_smarty_tpl->tpl_vars['config']->value['integral_pricename'];?>
：
            <font color="#FF6600"><?php echo $_smarty_tpl->tpl_vars['statis']->value['integral'];?>
</font>。
            <br />置顶结束时间：<span id='topdate'></span>。
            </div>
        </div>
        <div class="admin_Operating_sub" style="margin-top:10px;">
            <form action="index.php?c=resume&act=rtop" target="supportiframe" name="myform" method="post">
                <table cellspacing="2" cellpadding="3" style="width:100%">
                    <tr><td>置顶天数：</td>
                    <td><input name="days" class="message_box_text" type='text' onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"></td>
                    <td><input type="submit" class="com_pop_bth" value='确认' onclick="wait_result();"></td></tr>
                </table>
                <input name="eid" type="hidden" />
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class=foot><div class=copyright><?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webcopyright'];?>
 电话(Tel):<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webtel'];?>
</div></div>
<div id="uclogin" style="display:none"></div>
<iframe id="supportiframe" name="supportiframe" onload="returnmessage('supportiframe');" style="display:none"></iframe>
</BODY>
</HTML><?php }} ?>
