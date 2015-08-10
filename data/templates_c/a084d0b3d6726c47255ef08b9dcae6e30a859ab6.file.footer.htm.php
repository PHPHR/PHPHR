<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-07 15:10:13
         compiled from "/home/web/phphr//app/template/default/footer.htm" */ ?>
<?php /*%%SmartyHeaderCode:93520233955c459d5b15dd0-08358241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a084d0b3d6726c47255ef08b9dcae6e30a859ab6' => 
    array (
      0 => '/home/web/phphr//app/template/default/footer.htm',
      1 => 1438912818,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93520233955c459d5b15dd0-08358241',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'desc' => 0,
    'desclist' => 0,
    'lit' => 0,
    'config' => 0,
    'navlist_app' => 0,
    'style' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c459d5c7c766_18404392',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c459d5c7c766_18404392')) {function content_55c459d5c7c766_18404392($_smarty_tpl) {?><?php if (!is_callable('smarty_function_desc')) include '/home/web/phphr/app/include/libs/plugins/function.desc.php';
?><!--foot  start-->
<?php echo smarty_function_desc(array('assign_name'=>'desc'),$_smarty_tpl);?>

<div class="clear"></div>
<div class="footer">
  <div class="foot">
    <div class="foot_conent">
      <div class="footer_left"> <?php  $_smarty_tpl->tpl_vars['desclist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['desclist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['desc']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['desclist']->key => $_smarty_tpl->tpl_vars['desclist']->value) {
$_smarty_tpl->tpl_vars['desclist']->_loop = true;
?>
        <dl class="footer_list">
          <dt><?php echo $_smarty_tpl->tpl_vars['desclist']->value['name'];?>
</dt>
          <dd>
            <ul>
              <?php  $_smarty_tpl->tpl_vars['lit'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lit']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['desclist']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lit']->key => $_smarty_tpl->tpl_vars['lit']->value) {
$_smarty_tpl->tpl_vars['lit']->_loop = true;
?>
              <li><a 
              <?php if ($_smarty_tpl->tpl_vars['lit']->value['is_type']==1) {?>
              href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['lit']->value['url'];?>
"
               <?php } else { ?>
              href="<?php echo $_smarty_tpl->tpl_vars['lit']->value['url'];?>
"
               <?php }?>
               title="<?php echo $_smarty_tpl->tpl_vars['lit']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['lit']->value['name'];?>
</a></li>
              <?php } ?>
            </ul>
          <dd>
        </dl>
        <?php } ?> </div>
       <div class="footer_right" style="text-align:left">
        <div class="footer_touch">服务热线</div>
        <div class="footer_tel"><?php echo $_smarty_tpl->tpl_vars['config']->value['sy_freewebtel'];?>
</div>
        
        <ul class="footer_last">
        <?php  $_smarty_tpl->tpl_vars['navlist_app'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['navlist_app']->_loop = false;
global $db,$db_config,$config;include(PLUS_PATH."/menu.cache.php");$Navlist=array();
		if(is_array($menu_name)){
            eval('$paramer=array("item"=>"\'navlist_app\'","hovclass"=>"\'nav_list_hover\'","nid"=>"11","nocache"=>"")
;');
			$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
			$paramer = $ParamerArr[arr];
			$Purl =  $ParamerArr[purl];
			foreach($menu_name[12] as $key=>$val){
				if($val['type']=='2'){
					if($config['sy_seo_rewrite']=="1" && $val[furl]!=''){
						$menu_name[12][$key][url] = $val[furl];
					}else{
						$menu_name[12][$key][url] = $val[url];
					}
					$menu_name[12][$key][navclass] = navcalss($val,$paramer[hovclass]);
				}
			}
			foreach($menu_name[1] as $key=>$value){
				if($value['type']=='1'){
					if($config['sy_seo_rewrite']=="1" && $value[furl]!=''){
						$menu_name[1][$key][url] = $config[sy_weburl]."/".$value[furl];
					}else{
						$menu_name[1][$key][url] = $config[sy_weburl]."/".$value[url];
					}
					$menu_name[1][$key][navclass] = navcalss($value,$paramer[hovclass]);
				}
			}
			foreach($menu_name[2] as $key=>$value){
				if($value['type']=='1'){
					if($config['sy_seo_rewrite']=="1" && $value[furl]!=''){
						$menu_name[2][$key][url] = $config[sy_weburl]."/".$value[furl];
					}else{
						$menu_name[2][$key][url] = $config[sy_weburl]."/".$value[url];
					}
					$menu_name[2][$key][navclass] = navcalss($value,$paramer[hovclass]);
				}
			}
            $isCurrentFind=false;
			foreach($menu_name[4] as $key=>$value){
				if($value['type']=='1' && $value[furl]!=''){
					if($config['sy_seo_rewrite']=="1"){
						$menu_name[4][$key][url] = $config[sy_weburl]."/".$value[furl];
					}else{
						$menu_name[4][$key][url] = $config[sy_weburl]."/".$value[url];
					}
				}
                if($isCurrentFind==false){
				    $menu_name[4][$key][navclass] = navcalss($value,$paramer[hovclass]);
                }
                if($menu_name[4][$key][navclass]){
                    $isCurrentFind=true;
                }
			}
			foreach($menu_name[5] as $key=>$value){
				if($value['type']=='1'){
					if($config['sy_seo_rewrite']=="1" && $value[furl]!=''){
						$menu_name[5][$key][url] = $config[sy_weburl]."/".$value[furl];
					}else{
						$menu_name[5][$key][url] = $config[sy_weburl]."/".$value[url];
					}
					$menu_name[5][$key][navclass] = navcalss($value,$paramer[hovclass]);
				}
			}
		}
		if($paramer[nid]){
			$Navlist =$menu_name[$paramer[nid]];
		}else{
			$Navlist =$menu_name[1];
		}$Navlist = $Navlist; if (!is_array($Navlist) && !is_object($Navlist)) { settype($Navlist, 'array');}
foreach ($Navlist as $_smarty_tpl->tpl_vars['navlist_app']->key => $_smarty_tpl->tpl_vars['navlist_app']->value) {
$_smarty_tpl->tpl_vars['navlist_app']->_loop = true;
?>          
          <li style="width:70px; float:left; margin-top:5px; text-align:left"> <a class="move_0<?php echo $_smarty_tpl->tpl_vars['navlist_app']->value['sort'];?>
" style="color: #ff0000" <?php if ($_smarty_tpl->tpl_vars['navlist_app']->value['eject']) {?> target="_blank"<?php }?> href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['navlist_app']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['navlist_app']->value['name'];?>
</a> </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="clear"></div>
    <div class="footer_bot">
      <div class="footer_bot_p"><?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webcopyright'];
echo $_smarty_tpl->tpl_vars['config']->value['sy_webrecord'];?>
 </div>
      <div class="footer_bot_p">	地址:<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webadd'];?>
  电话(Tel):<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webtel'];?>
  EMAIL:<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webemail'];?>
</div>
      <div class="footer_img"> 
      <a href="/"><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/ftImg01.png" width="120" height="52"> </a> 
      <a href="/"><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/ftImg02.png" width="120" height="52"> </a> 
      <a href="/"><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/ftImg03.png" width="120" height="52"> </a> 
	  <?php echo $_smarty_tpl->tpl_vars['config']->value['sy_webtongji'];?>

      </div>
    </div>
  </div>
</div>
<!--foot  end--> 
<div id="bg" style=""></div>
<div id="uclogin" style="display:none"></div>
<?php echo '<script'; ?>
>var integral_pricename='<?php echo $_smarty_tpl->tpl_vars['config']->value['integral_pricename'];?>
';var weburl="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
"; <?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
