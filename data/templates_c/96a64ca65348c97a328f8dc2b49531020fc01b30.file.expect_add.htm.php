<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 17:06:16
         compiled from "/var/www/phphr/app/template/member/user/expect_add.htm" */ ?>
<?php /*%%SmartyHeaderCode:95896908755c1d208c2d7c6-66169801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96a64ca65348c97a328f8dc2b49531020fc01b30' => 
    array (
      0 => '/var/www/phphr/app/template/member/user/expect_add.htm',
      1 => 1435200702,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95896908755c1d208c2d7c6-66169801',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'style' => 0,
    'industry_index' => 0,
    'v' => 0,
    'industry_name' => 0,
    'userdata' => 0,
    'userclass_name' => 0,
    'city_index' => 0,
    'city_name' => 0,
    'row' => 0,
    'resume' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1d208cd8325_58033955',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1d208cd8325_58033955')) {function content_55c1d208cd8325_58033955($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['userstyle']->value)."/header.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tplstyle']->value)."/public_search/index_search.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/data/plus/job.cache.js" type="text/javascript"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/style/class.public.css" type="text/css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/class.public.js" type="text/javascript"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
>
function checkexpect(){

	if($.trim($('#name').val())==''){
		layer.msg("����д�������ƣ�",2,8);return false;
	}
	if($('#hyid').val()==''){
		layer.msg("��ѡ�������ҵ��",2,8);return false;
	}
	if($('#job_class').val()==''){
		layer.msg("��ѡ������ְλ��",2,8);return false;
	}
	if($('#salaryid').val()==''){
		layer.msg("��ѡ������н�ʣ�",2,8);return false;
	}
	if($('#provinceid').val()==''){
		layer.msg("��ѡ���������У�",2,8);return false;
	}
	if($('#reportid').val()==''){
		layer.msg("��ѡ�񵽸�ʱ�䣡",2,8);return false;
	}
	if($('#typeid').val()==''){
		layer.msg("��ѡ�������ʣ�",2,8);return false;
	}
	if($('#statusid').val()==''){
		layer.msg("��ѡ����ְ״̬��",2,8);return false;
	}
	if($.trim($('#uname').val())==''){
		layer.msg("����д��ʵ������",2,8);return false;
	}
	if($('#sexid').val()==''){
		layer.msg("��ѡ���Ա�",2,8);return false;
	}
	if($('#birthday').val()==''){
		layer.msg("��ѡ��������£�",2,8);return false;
	}
	if($('#eduid').val()==''){
		layer.msg("��ѡ�����ѧ����",2,8);return false;
	}
	if($('#expid').val()==''){
		layer.msg("��ѡ�������飡",2,8);return false;
	}
	if($('#telphone').val()==''){
		layer.msg("����д�ֻ����룡",2,8);return false;
	}else{
	  var reg= /^[1][34578]\d{9}$/; //��֤�ֻ�����  
		 if(!reg.test($('#telphone').val())){
			layer.msg("�ֻ������ʽ����",2,8);return false;
		 }
	}
	if($('#email').val()==''){
		layer.msg("����д��ϵ���䣡",2,8);return false;
	}else{
		var myreg = /^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	   if(!myreg.test($('#email').val())){
			layer.msg("�����ʽ����",2,8);return false;
			return false;
	   }
	}
	if($.trim($('#living').val())==''){
		layer.msg("�������־�ס�أ�",2,8);return false;
	}
}
<?php echo '</script'; ?>
>
 <form action="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/member/?c=expect&act=add" method="post" target="supportiframe" onsubmit="return checkexpect();">
 
 <div class="news_expect">
<div class="news_expect_cont">
<div class="news_expect_cont_h1"><span class="news_expect_cont_h1_s">��������ְ���������õļ������ܸ����ҵ��ù�����<span class="news_expect_cont_bt">����</span></span><a href="index.php" class="news_expect_cont_h1_a">�����ҵ���ְ��ҳ>></a></div>
<div class="news_expect_content">
<div class="news_expect_list"><span class="news_expect_list_span">�������ƣ�</span>
<input type="text" value="" name="name" id="name" class="news_expect_text_t1">
<span class="news_expect_name">�磺�����ܼ�,���۾���</span>
</div>


<div class="news_expect_list"><span class="news_expect_list_span">������ҵ��</span>
<div class="news_expect_text_big  news_expect_text_re10">


<input class="news_expect_bth_big" type="button" value="��ѡ�������ҵ" id="hy" onclick="search_show('job_hy');">
	<input type="hidden" id="hyid" name="hy" value="" />
	<div class="news_expect_text_box " style="display:none" id="job_hy">
		<ul class="news_expect_text_box_list">
			 <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['industry_index']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
				<li><a href="javascript:;" onclick="selects('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
','hy','<?php echo $_smarty_tpl->tpl_vars['industry_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
');"> <?php echo $_smarty_tpl->tpl_vars['industry_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a></li>
				<?php } ?>
		</ul>
	</div>
	<span id="by_hyid" style="display:none">��ѡ������н��</span>


</div>

</div>

<div class="news_expect_list"><span class="news_expect_list_span">����ְλ��</span>
<div class="news_expect_text_big  news_expect_text_re9">

<input type="button" value=" ��ѡ�� " style=" float:left;" class="news_expect_bth_big" onclick="index_job(5,'#workadds_job','#job_class','left:100px;top:100px; position:absolute;');" id="workadds_job" >

 <input name='job_class' id='job_class'  value=""type='hidden' />

</div>
</div>
<div class="news_expect_list"><span class="news_expect_list_span">����н�ʣ�</span>
<div class="news_expect_text  news_expect_text_re8">
<input class="news_expect_bth_button" type="button" value="��ѡ������н��" id="salary" onclick="search_show('job_salary');">
	<input type="hidden" id="salaryid" name="salary" value="" />
	<div class="news_expect_text_box news_expect_text_box_200" style="display:none" id="job_salary">
		<ul class="news_expect_text_box_list">
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userdata']->value['user_salary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			<li>
				<a href="javascript:;" onclick="selects('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
','salary','<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
');"> <?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<span id="by_salaryid" style="display:none">��ѡ������н��</span>
</div>
</div>
<div class="news_expect_list"><span class="news_expect_list_span">�������У�</span>
<div class="news_expect_text_w130  news_expect_text_re7">
<input class="news_expect_bth_w130" type="button" value="��ѡ��ʡ��" id="province" onclick="search_show('job_province');">
<input type="hidden" id="provinceid" name="provinceid" value="" />

<div class="news_expect_text_box news_expect_text_box_130" id="job_province" style="display:none;">
<ul class="news_expect_text_box_list">
<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['city_index']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	<li>
		<a href="javascript:;" onclick="select_city('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
','province','<?php echo $_smarty_tpl->tpl_vars['city_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
','citys','city');"><?php echo $_smarty_tpl->tpl_vars['city_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a>
	</li>
	<?php } ?>
</ul>
</div>
</div>
<div class="news_expect_text_w130  news_expect_text_re7">
 <input class="news_expect_bth_w130" type="button" value="��ѡ�����" id="citys" onclick="search_show('job_citys');">
 <input type="hidden" id="citysid" name="citysid" value="" />

<div class="news_expect_text_box news_expect_text_box_city  news_expect_text_box_130" id="job_citys" style="display:none;">
<ul class="news_expect_text_box_list">

</ul>
</div>
</div>
<div class="news_expect_text_w130  news_expect_text_re7" id="cityshowth">
 <input class="news_expect_bth_w130" type="button" value="��ѡ������" id="three_city" onclick="search_show('job_three_city');">

<input type="hidden" id="three_cityid" name="three_cityid" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['three_cityid'];?>
" />

<div class="news_expect_text_box news_expect_text_box_city news_expect_text_box_130" id="job_three_city" style="display:none;">
<ul class="news_expect_text_box_list">

</ul>
</div>
</div>
</div>




<div class="news_expect_list"><span class="news_expect_list_span">�������ʣ�</span>
<div class="news_expect_text  news_expect_text_re6">

<input class="news_expect_bth_button" type="button" value="��ѡ��������" id="type" onclick="search_show('job_type');">
	<input type="hidden" id="typeid" name="type" value="" />
	<div class="news_expect_text_box news_expect_text_box_200" style="display:none" id="job_type">
		<ul class="news_expect_text_box_list">
			  <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userdata']->value['user_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
				<li><a href="javascript:;" onclick="selects('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
', 'type', '<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
');"> <?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a></li>
				<?php } ?>
		</ul>
	</div>
	<span id="by_salaryid" style="display:none">��ѡ��������</span>

</div>
</div>


<div class="news_expect_list"><span class="news_expect_list_span">����ʱ�䣺</span>
<div class="news_expect_text  news_expect_text_re5">

<input class="news_expect_bth_button" type="button" value="��ѡ�񵽸�ʱ��" id="report" onclick="search_show('job_report');">
	<input type="hidden" id="reportid" name="report" value="" />
	<div class="news_expect_text_box news_expect_text_box_200" style="display:none" id="job_report">
		<ul class="news_expect_text_box_list">
			  <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userdata']->value['user_report']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
				<li><a href="javascript:;" onclick="selects('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
', 'report', '<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
');"> <?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a></li>
				<?php } ?>
		</ul>
	</div>
	<span id="by_salaryid" style="display:none">��ѡ�񵽸�ʱ��</span>

</div>
</div>

<div class="news_expect_list">
<span class="news_expect_list_span">��ְ״̬��</span>
<div class="news_expect_text_big  news_expect_text_re4">

<input class="news_expect_bth_big" type="button" value="��ѡ����ְ״̬" id="status" onclick="search_show('jobstatus');">
	<input type="hidden" id="statusid" name="jobstatus" value="" />
	<div class="news_expect_text_box" style="display:none" id="jobstatus">
		<ul class="news_expect_text_box_list">
			  <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userdata']->value['user_jobstatus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
				<li><a href="javascript:;" onclick="selects('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
', 'status', '<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
');"> <?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a></li>
				<?php } ?>
		</ul>
	</div>
	<span id="by_salaryid" style="display:none">��ѡ����ְ״̬</span>

</div>
</div>
<div class="news_expect_list"><span class="news_expect_list_span">��ʵ������</span>
<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['resume']->value['name'];?>
" name="uname" id="uname" class="news_expect_text_t1" style="width:180px;">
</div>

<div class="news_expect_list"><span class="news_expect_list_span">�Ա�</span>
 <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userdata']->value['user_sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	<span class="news_expect_list_s"><input id="sex<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" type="radio" <?php if ($_smarty_tpl->tpl_vars['resume']->value['sex']==$_smarty_tpl->tpl_vars['v']->value) {?>checked ="checked" <?php } elseif ($_smarty_tpl->tpl_vars['resume']->value['sex']==''&&$_smarty_tpl->tpl_vars['key']->value==0) {?>checked="checked"<?php }?>
	value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" name="sex">
	<label for="sex<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</label></span>
	<?php } ?>
	<span id="by_sex" style="display:none">��ѡ���Ա�</span>

</div>
<div class="news_expect_list">
<link href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/time/jscal2.css" type="text/css" rel="stylesheet">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/time/calendar.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/time/en.js" type="text/javascript"><?php echo '</script'; ?>
>
<span class="news_expect_list_span">�������£�</span>
<div class="news_expect_text  news_expect_text_re3" style="width:210px;">

 <input id="birthday" type="text" readonly="" size="10" value="1988-08-08" name="birthday" class="news_expect_bth_button">
	<?php echo '<script'; ?>
 type="text/javascript">
		Calendar.setup({
			weekNumbers: true,
			inputField: "birthday",
			trigger: "birthday",
			dateFormat: "%Y-%m-%d",
			showTime: false,
			onSelect: function () { this.hide(); }
		});
	<?php echo '</script'; ?>
>
</div>
</div>


<div class="news_expect_list"><span class="news_expect_list_span">���ѧ����</span>
<div class="news_expect_text  news_expect_text_re2">

<input class="news_expect_bth_button" type="button" <?php if ($_smarty_tpl->tpl_vars['resume']->value['edu']=='') {?>value="��ѡ�����ѧ��"<?php } else { ?> value="<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['resume']->value['edu']];?>
"<?php }?> id="educ" onclick="search_show('job_educ');">
	<input type="hidden" id="educid" name="edu" value="<?php echo $_smarty_tpl->tpl_vars['resume']->value['edu'];?>
" />
	<div class="news_expect_text_box news_expect_text_box_200" style="display:none" id="job_educ">
		<ul class="news_expect_text_box_list">
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userdata']->value['user_edu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			<li>
				<a href="javascript:;" onclick="selects('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
','educ','<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
');"> <?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<span id="by_educid" style="display:none">��ѡ�����ѧ��</span>




</div>
</div>
<div class="news_expect_list"><span class="news_expect_list_span">�������飺</span>
<div class="news_expect_text  news_expect_text_re1">

<input class="news_expect_bth_button" type="button" <?php if ($_smarty_tpl->tpl_vars['resume']->value['exp']=='') {?>value="��ѡ��������"<?php } else { ?> value="<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['resume']->value['exp']];?>
"<?php }?> id="exp" onclick="search_show('job_exp');">
	<input type="hidden" id="expid" name="exp" value="<?php echo $_smarty_tpl->tpl_vars['resume']->value['exp'];?>
" />
	<div class="news_expect_text_box news_expect_text_box_200" style="display:none" id="job_exp">
		<ul class="news_expect_text_box_list">
			 <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['userdata']->value['user_word']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			<li><a href="javascript:;" onclick="selects('<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
','exp','<?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
');"> <?php echo $_smarty_tpl->tpl_vars['userclass_name']->value[$_smarty_tpl->tpl_vars['v']->value];?>
</a></li>
			<?php } ?>
		</ul>
	</div>
	<span id="by_expid" style="display:none">��ѡ��������</span>

</div>
</div>
<div class="news_expect_list"><span class="news_expect_list_span">�ֻ����룺</span>
<input name="telphone" id="telphone" type="text" value="<?php echo $_smarty_tpl->tpl_vars['resume']->value['telphone'];?>
" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" class="news_expect_text_t1" />
<span id="by_telphone" style="display:none">����ȷ��д�ֻ�����</span>

</div>
<div class="news_expect_list"><span class="news_expect_list_span">��ϵ���䣺</span>
 <input name="email" id="email" type="text" size="30" value="<?php echo $_smarty_tpl->tpl_vars['resume']->value['email'];?>
" class="news_expect_text_t1" />
	<span id="by_email" class="errordisplay">�ʼ���ʽ����</span>
</div>

<div class="news_expect_list"><span class="news_expect_list_span">�־�ס�أ�</span><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['resume']->value['living'];?>
" name="living" class="news_expect_text_t1" id="living">
</div>


<div class="news_expect_list"><span class="news_expect_list_span">&nbsp;</span><input type="submit"  class="news_expect_list_sub" value="����" name="submit"></div>
</div>
</div>
</div>
</form>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['userstyle']->value)."/footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
