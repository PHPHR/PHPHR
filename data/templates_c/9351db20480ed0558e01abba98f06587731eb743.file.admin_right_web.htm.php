<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-07 10:18:21
         compiled from "/home/web/phphr/app/template/admin/admin_right_web.htm" */ ?>
<?php /*%%SmartyHeaderCode:87477542755c4156d4afc23-52479118%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9351db20480ed0558e01abba98f06587731eb743' => 
    array (
      0 => '/home/web/phphr/app/template/admin/admin_right_web.htm',
      1 => 1438912823,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87477542755c4156d4afc23-52479118',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'name' => 0,
    'list' => 0,
    'daylist' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c4156d4fea70_61691613',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c4156d4fea70_61691613')) {function content_55c4156d4fea70_61691613($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="images/reset.css" rel="stylesheet" type="text/css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/jquery-1.8.0.min.js"><?php echo '</script'; ?>
>
<title>��̨����</title>
</head>
<body class="body_ifm">
<div class="admin_atatic_chart fl" id="main2" style="height:300px;"></div>
    <!-- ECharts���ļ����� -->
    <?php echo '<script'; ?>
 src="js/echarts_plain.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        // ����׼���õ�dom����ʼ��echartsͼ��
        var myChart = echarts.init(document.getElementById('main2')); 
        var option = {tooltip : {trigger: 'axis'},legend: {data:['<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
']},
    calculable : false,
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : [<?php  $_smarty_tpl->tpl_vars['daylist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['daylist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['daylist']->key => $_smarty_tpl->tpl_vars['daylist']->value) {
$_smarty_tpl->tpl_vars['daylist']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']>0) {?>,<?php }?>'<?php echo $_smarty_tpl->tpl_vars['daylist']->value['td'];?>
'<?php } ?>]
        }
    ],
    yAxis : [{type : 'value'}],
    series : [
        {
            name:'<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
',
            type:'line',
            symbol:'emptyCircle',
            smooth:false,
            itemStyle: {
                normal: {
                    areaStyle: {
                        width: 2,
						color:'rgb(191,227,249)'
					}
                }
            },
            data:[<?php  $_smarty_tpl->tpl_vars['daylist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['daylist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo1']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['daylist']->key => $_smarty_tpl->tpl_vars['daylist']->value) {
$_smarty_tpl->tpl_vars['daylist']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo1']['index']++;
if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo1']['index']>0) {?>,<?php }
echo $_smarty_tpl->tpl_vars['daylist']->value['cnt'];
} ?>]
        }
    ]
};
        myChart.setOption(option); // Ϊecharts����������� 
    <?php echo '</script'; ?>
>
</body>
</html><?php }} ?>