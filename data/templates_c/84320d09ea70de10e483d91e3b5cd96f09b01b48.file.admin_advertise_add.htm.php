<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-07 10:18:25
         compiled from "/home/web/phphr/app/template/admin/admin_advertise_add.htm" */ ?>
<?php /*%%SmartyHeaderCode:174535722955c415717f9ec8-62625418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84320d09ea70de10e483d91e3b5cd96f09b01b48' => 
    array (
      0 => '/home/web/phphr/app/template/admin/admin_advertise_add.htm',
      1 => 1438912824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174535722955c415717f9ec8-62625418',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'ad_info' => 0,
    'domainname' => 0,
    'class' => 0,
    'list' => 0,
    'lasturl' => 0,
    'pytoken' => 0,
    'domain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c415718e5837_99012109',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c415718e5837_99012109')) {function content_55c415718e5837_99012109($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
function checkform(){
	if($("#ad_name").val()==""){ 
		parent.layer.msg('������Ʋ���Ϊ�գ�', 2,2);
		return false;
	}
	if($("#ad_start").val()==""){ 
		parent.layer.msg('����д��ʼʱ�䣡', 2,2);
		return false;
	}
	if($("#ad_end").val()==""){ 
		parent.layer.msg('����д����ʱ�䣡', 2,2);
		return false;
	}
	if($("#ad_start").val()!="" && $("#ad_end").val()!="" ){
		 var time1 = $("#ad_start").val() ;
		 var time2 = $("#ad_end").val();
		 time1arr = time1.split("-");
		 time2arr = time2.split("-");
		 date1 = new Date(time1arr[0],time1arr[1],time1arr[2]);
		 date2 = new Date(time2arr[0],time2arr[1],time2arr[2]);
		 if(date1>date2){ 
			 parent.layer.msg('����ʱ�䲻�õ��ڿ�ʼʱ�䣬�������趨��', 2,2);
			 return false;
		}
	} 
	var item = $('input[name="ad_type"]:checked').val();
	
	if(!item){
		 parent.layer.msg('��ѡ��һ�ֹ�����ͣ�', 2,2); return false;
	}else{ 
		if(item=="word"&&$("input[name=word_info]").val()==""){
			parent.layer.msg('����д������Ϣ��', 2,2); return false;
		}

	}
}
function replace_type(type){
	if(type=="word"){
		$("#word").attr("style","display:");
		$("#pic").attr("style","display:none");
		$("#flash").attr("style","display:none");
	}else if(type=="pic"){
		$("#word").attr("style","display:none");
		$("#pic").attr("style","display:");
		$("#flash").attr("style","display:none");
	}else if(type=="flash"){
		$("#word").attr("style","display:none");
		$("#pic").attr("style","display:none");
		$("#flash").attr("style","display:");
	}
}
function adpic_url(){
	$("#typeid").html("<input  type='file' id='pic_url' name='ad_url' value='' class=\"input-text\"><label><input id='upload' type='radio' name='upload'  onclick='adpic_src();'>Զ�̵�ַ</label><label><input id='upload_pic' type='radio' checked name='upload' onclick='adpic_url();'>�����ϴ�</label>");
}
function adpic_src(){
	$("#typeid").html("<input class='input-text'  type='text' id='pic_url' name='ad_url' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['pic_url'];?>
'><label><input id='upload' checked type='radio' name='upload'>Զ�̵�ַ</label><label><input id='upload_pic' type='radio' name='upload' onclick='adpic_url();'>�����ϴ�</label>");
} 
function adflash_url(){
	$("#flashid").html("<input  type='file'  name='ad_url' value='' class=\"input-text\"><label><input id='flash'  type='radio' name='flash'  onclick='adflash_src();' >Զ�̵�ַ</label><label><input id='upload_flash' type='radio' checked name='upload_flash' onclick='adflash_url();'>�����ϴ�</label>");
}
function adflash_src(){
	$("#flashid").html("<input class='input-text'  type='text'  name='ad_url' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['flash_url'];?>
'><label><input id='upload' checked type='radio' name='upload' >Զ�̵�ַ</label><label><input id='upload_pic' type='radio' name='upload' onclick='adflash_url();'>�����ϴ�</label>");
}
<?php echo '</script'; ?>
>
<style>
* {margin: 0 ;padding: 0;}
body,div{ margin: 0 ;padding: 0;}
</style>
<title>��̨����</title>
</head>
<body class="body_ifm">
<div class="infoboxp">
<div class="infoboxp_top_bg"></div>
<div class="admin_Prompt">
<div class="admin_Prompt_span">
    ע�������ӹ��ʱ������ȷѡ���������͡�
</div><div class="admin_Prompt_close"></div></div>
  <div class="infoboxp_top">
      <span class="admin_title_span"><?php if (is_array($_smarty_tpl->tpl_vars['ad_info']->value)) {?>���¹��<?php } else { ?>��ӹ��<?php }?></span>
      </div>
   <div class="clear"></div>
  <div class="admin_table_border">
  <iframe id="supportiframe"  name="supportiframe" onload="returnmessage('supportiframe');" style="display:none"></iframe> 
  <form name="myform" target="supportiframe" action="<?php if (is_array($_smarty_tpl->tpl_vars['ad_info']->value)) {?>index.php?m=advertise&c=modify_save<?php } else { ?>index.php?m=advertise&c=ad_saveadd<?php }?>" method="post" encType="multipart/form-data" onsubmit="return checkform();">
    <table width="100%" class="table_form" style="background:#fff">
      <tr >
        <th width="200">������ƣ�</th>
        <td>
        <input class="input-text" id="ad_name" value="<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['ad_name'];?>
" name="ad_name" size="30">
        <label><input type="checkbox" name="target" value="2" <?php if ($_smarty_tpl->tpl_vars['ad_info']->value['target']!=1) {?>checked<?php }?>>�´���</label>
        </td>
      </tr>
     <tr class="admin_table_trbg">
        <th>ʹ�÷�Χ��</th>
        <td><input type="button" value="<?php if ($_smarty_tpl->tpl_vars['domainname']->value!='') {
echo $_smarty_tpl->tpl_vars['domainname']->value;
} else { ?>ȫվ<?php }?>" class="city_news_but" onClick="domain_show();">
        <input type="hidden" id="did" value="<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['did'];?>
" name="did"></td>
      </tr> 
     	<tr>
        <th width="200">����������ࣺ</th>
        <td><select name="class_id">
        	<?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['class']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
        	<option value="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['list']->value['id']==$_smarty_tpl->tpl_vars['ad_info']->value['class_id']) {?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['list']->value['class_name'];?>
</option>
            <?php } ?>
        </select></td>
      </tr> 
	  <tr class="admin_table_trbg">
        <th width="200">����Ƿ����ã�</th>
        <td>
		<input name='is_open' value='1' type='radio' checked>����
		<input name='is_open' value='0' <?php if ('0'==$_smarty_tpl->tpl_vars['ad_info']->value['is_open']) {?>checked<?php }?> type='radio'>�ر�
		</td>
      </tr>
	  <tr>
        <th width="200">����</th>
        <td><input id="sort" class="input-text" value="<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['sort'];?>
" name="sort" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')">Խ��Խ��ǰ</td>
      </tr>
      <tr class="admin_table_trbg">
        <th width="200">��ʼʱ�䣺</th>
        <td>
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
        <input id="ad_start" class="input-text" type="text" readonly size="20" value="<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['time_start'];?>
" name="time_start">
        <?php echo '<script'; ?>
 type="text/javascript">
        Calendar.setup({
        weekNumbers: true,
        inputField : "ad_start",
        trigger : "ad_start",
        dateFormat: "%Y-%m-%d",
        showTime: false,
        onSelect : function() {this.hide();}
        });
        <?php echo '</script'; ?>
>
        &nbsp;&nbsp;����ʱ�䣺
        <input id="ad_end" class="input-text" type="text" readonly size="20" value="<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['time_end'];?>
" name="time_end">
        <?php echo '<script'; ?>
 type="text/javascript">
        Calendar.setup({
        weekNumbers: true,
        inputField : "ad_end",
        trigger : "ad_end",
        dateFormat: "%Y-%m-%d",
        showTime: false,
        onSelect : function() {this.hide();}
        });
        <?php echo '</script'; ?>
>
          </td>
      </tr>
		<tr>
			<th width="200">��ע��</th>
			<td><textarea class="text" cols="50" rows="3" name="remark"><?php echo $_smarty_tpl->tpl_vars['ad_info']->value['remark'];?>
</textarea></td>
		</tr>
     	<tr>
        <th width="200">������ͣ�</th>
        <td colspan="2"><label><input type="radio" id="word_ad" name="ad_type" value="word" onClick="replace_type('word');" <?php if ($_smarty_tpl->tpl_vars['ad_info']->value['ad_type']=="word") {?>checked<?php }?>>���ֹ��</label>
          <label><input  value="pic" type="radio" id="pic_ad" name="ad_type" onClick="replace_type('pic');" <?php if ($_smarty_tpl->tpl_vars['ad_info']->value['ad_type']=="pic") {?>checked<?php }?>>ͼƬ���</label>
         <label> <input type="radio" value="flash" id="flash_ad" name="ad_type" onClick="replace_type('flash');"<?php if ($_smarty_tpl->tpl_vars['ad_info']->value['ad_type']=="flash") {?>checked<?php }?>>FLASH���</label>
          </td>
      </tr>
      <tr> 
      <td class="admin_table_trbg" colspan="2" style="padding:0; background:none">
      <table width="100%" id="word" style="display:none">
    	<tr class="admin_table_trbg">
           <th width="200" >������Ϣ��</th>
        <td ><input class='input-text' id="word_info"    name='word_info' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['word_info'];?>
'></td>
      </tr>
      <tr>
        <th>�������ӣ�</th>
        <td><input class='input-text' id="word_url"    name='word_url' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['word_url'];?>
'>�ⲿ��������ϡ�http://��</td>
      </tr>
      </table>
	   </td>
      </tr>
	  <tr>
      <td colspan="2">
      <table id="pic" style="display:none"width="100%">
      <tr class="admin_table_trbg">
        <th width="200" >ͼƬ��ַ��</th>
        <td  id='typeid'><input class='input-text' type='text' id='pic_url' name='pic_url' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['pic_url'];?>
'  >
          <label><input id='upload' checked type='radio' name='upload'>Զ�̵�ַ</label>
          <label><input id='upload_pic' type='radio' name='upload' onclick='adpic_url();'>�����ϴ�</label>
          </td>
      </tr>
      <tr>
        <th>ͼƬ���ӣ�</th>
        <td><input class='input-text' id="pic_src" name='pic_src' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['pic_src'];?>
'  >�ⲿ��������ϡ�http://��</td>
      </tr>
      <tr class="admin_table_trbg">
        <th>ͼƬ��ȣ�</th>
        <td><input class='input-text' id="pic_width" size='8'onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" name='pic_width' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['pic_width'];?>
'>px(����) &nbsp;&nbsp;ͼƬ�߶ȣ�<input class='input-text' id="pic_height" size='8' onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" name='pic_height' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['pic_height'];?>
'>px(����)</td>
      </tr>
       </table>
	   <table id="flash" style="display:none" width="100%">
		   <tr class="admin_table_trbg">
			<th width="200">FLASH��ַ��</th>
			<td id='flashid'><input class='input-text' id="flash_url"  name='flash_url' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['flash_url'];?>
'   >
			  <label><input type='radio' id='flash' checked name='flash'>Զ�̵�ַ</label>
			 <label> <input type='radio' id='upload_flash' name='upload_flash'  onclick='adflash_url();'>�����ϴ�</label>
             </td>
		  </tr>
		  <tr>
			  <th >FLASH��ȣ�</th>
			<td><input class='input-text' id="flash_width" name='flash_width' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['flash_width'];?>
'>
            FLASH�߶ȣ�<input class='input-text' id="flash_height" name='flash_height' value='<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['flash_height'];?>
'></td>
      </tr>
      </table>
      </td>
      </tr>
      <?php if (is_array($_smarty_tpl->tpl_vars['ad_info']->value)) {?>
      <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['id'];?>
">
      <input type="hidden" name="lasturl" value="<?php echo $_smarty_tpl->tpl_vars['lasturl']->value;?>
">
      <?php }?>
      <tr class="admin_table_trbg">
        <td align="center" colspan="2">
        <input type="hidden" name="pytoken" value="<?php echo $_smarty_tpl->tpl_vars['pytoken']->value;?>
">
        <input class="admin_submit4" type="submit" name="submit" value="&nbsp;��  ��&nbsp;" />
        <input class="admin_submit4" type="reset" name="reset" value="&nbsp;�� �� &nbsp;" /></td>
      </tr>
    </table>
  </form>
</div></div>
</div>
<?php echo '<script'; ?>
>
replace_type("<?php echo $_smarty_tpl->tpl_vars['ad_info']->value['ad_type'];?>
");
<?php echo '</script'; ?>
>
<div id="domainlist" style="display:none;">
<div class="fz_city_news_cont" style="padding:10px;">
<span class="fz_city_news"><label class="fz_label"><input type="radio" name="did" onClick="check_domain('ȫվ','0')" value="0" checked class="fz_city_news_check">ȫվ</label></span>
<?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['domain']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
<span class="fz_city_news"><label class="fz_label"><input type="radio" name="did" onClick="check_domain('<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
','<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
')" <?php if ($_smarty_tpl->tpl_vars['list']->value['id']==$_smarty_tpl->tpl_vars['ad_info']->value['did']) {?>checked<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" class="fz_city_news_check"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</label></span>
<?php } ?>
</div>
</div>
</body>
</html><?php }} ?>
