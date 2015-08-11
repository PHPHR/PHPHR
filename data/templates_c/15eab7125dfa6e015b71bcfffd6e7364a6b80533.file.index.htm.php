<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-09 12:04:45
         compiled from "/var/www/phphr/app/template/default/index/index.htm" */ ?>
<?php /*%%SmartyHeaderCode:199551285655c1b852bc8348-26866070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15eab7125dfa6e015b71bcfffd6e7364a6b80533' => 
    array (
      0 => '/var/www/phphr/app/template/default/index/index.htm',
      1 => 1439092618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199551285655c1b852bc8348-26866070',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1b852deda93_59043136',
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1b852deda93_59043136')) {function content_55c1b852deda93_59043136($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta charset="GBK" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/css/style.css" />
<!--[if lte IE 6]><?php echo '<script'; ?>
 src="js/DD_belatedPNG_0.0.8a-min.js" type="text/javascript"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 type="text/javascript">	DD_belatedPNG.fix('*');<?php echo '</script'; ?>
><![endif]-->
<!-- 加载jQuery1.7.2版本-->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/js/jquery-1.7.2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/js/JQ_common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/js/jquery.SuperSlide.2.1.js"><?php echo '</script'; ?>
>
</head>

<body>
<div id="header" class="h70">
	<div class="header head0">
    	<div class="logo"><b>药师多医药人才网</b><span>专注于医药行业职业机会</span></div>
        <div class="btn"><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/index.php?m=login">登录</a> / <a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/index.php?m=register&usertype=1">注册</a></div>
        <ul class="nav">
        <li><a href="#" class="hover">首页</a></li>
        <li><a href="#">招人才</a></li>
        <li><a href="#">找工作</a></li>
        </ul>
  		<div class="clear"></div>      
    </div>
</div>
<div id="main" class="index">
	<div id="slideBox" class="slideBox">
        <div class="hd">
            <ul><li>1</li><li>2</li><li>3</li></ul>
        </div>
        <div class="bd">
            <ul>
                <li><a href="#" style="background:url(<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/images/ysd_1.jpg) top center no-repeat; height:536px;"></a></li>
				<li><a href="#" style="background:url(<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/images/ysd_1.jpg) top center no-repeat; height:536px;"></a></li>
                <li><a href="#" style="background:url(<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/images/ysd_1.jpg) top center no-repeat; height:536px;"></a></li>
            </ul>
        </div>
    </div>
    <?php echo '<script'; ?>
 type="text/javascript">
    $(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
    <?php echo '</script'; ?>
>
	<div class="main">
    	<div class="m_bg">
        	<div class="blank"></div>
        	<div class="m_wrap1">
                <div class="hd">
                    <ul><li class="on">人才</li><li>职位</li><li>企业</li></ul>
                </div>
                <div class="bd">
                    <div class="none" style="display:block;">
                    	<form method="get" name="" action="" target="_blank">
                            <div id="searchTxt" class="searchTxt" onMouseOver="this.className='searchTxt searchTxtHover';" onMouseOut="this.className='searchTxt';">
                                <div class="searchMenu">
                                    <div class="searchSelected" id="searchSelected">城市</div>
                                    <div style="display:none;" class="searchTab" id="searchTab">
                                        <div class="radius" style="top:259px;"></div>
                                        <div class="radius" style="top:259px;left:59px;"></div>
                                        <ul>
                                            <li class="">城市</li>
                                            <li>城市</li>
                                            <li>城市</li>
                                        </ul>
                                    </div>                                
                                </div>
                                <input name="w" type="text" /> 
                            </div>
                            
                            <div class="searchBtn">
                                <button id="searchBtn" type="submit" value=""></button>
                            </div>
                        </form>
                    </div>
                    <div class="none">
                    	<form method="get" name="" action="" target="_blank">
                            <div id="searchTxt" class="searchTxt" onMouseOver="this.className='searchTxt searchTxtHover';" onMouseOut="this.className='searchTxt';">
                                <div class="searchMenu">
                                    <div class="searchSelected" id="searchSelected">城市</div>
                                    <div style="display:none;" class="searchTab" id="searchTab">
                                        <div class="radius" style="top:259px;"></div>
                                        <div class="radius" style="top:259px;left:59px;"></div>
                                        <ul>
                                            <li class="">城市</li>
                                            <li>城市</li>
                                            <li>城市</li>
                                        </ul>
                                    </div>                                
                                </div>
                                <input name="w" type="text" /> 
                            </div>
                            
                            <div class="searchBtn">
                                <button id="searchBtn" type="submit" value=""></button>
                            </div>
                        </form>
                    </div>
                    <div class="none">
                    	<form method="get" name="" action="" target="_blank">
                            <div id="searchTxt" class="searchTxt" onMouseOver="this.className='searchTxt searchTxtHover';" onMouseOut="this.className='searchTxt';">
                                <div class="searchMenu">
                                    <div class="searchSelected" id="searchSelected">城市</div>
                                    <div style="display:none;" class="searchTab" id="searchTab">
                                        <div class="radius" style="top:259px;"></div>
                                        <div class="radius" style="top:259px;left:59px;"></div>
                                        <ul>
                                            <li class="">城市</li>
                                            <li>城市</li>
                                            <li>城市</li>
                                        </ul>
                                    </div>                                
                                </div>
                                <input name="w" type="text" /> 
                            </div>
                            
                            <div class="searchBtn">
                                <button id="searchBtn" type="submit" value=""></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    	<div class="m_wrap">
        	<div class="box l"><a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/images/ysd_4.jpg"><p>药师多人才网秉承 "服务于医药行业，专注于医药企业" </p></a></div>
            <div class="box r"><a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/images/ysd_5.jpg"><p>"服务于医药行业，专注于医药企业" 的经营理念为客户创造最大的价值</p></a></div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="footer">
	<div class="footer">
    	<ul class="f_box">
        <li>
            <div class="p1">全国统一服务热线：</div>
            <div class="p2">400-067-3800</div>
            <div class="p3">工作日：9：00 ~ 18：00</div>
        </li>
        <li style="margin-right:0;">
        	<div class="p4"><a href="#">关于我们</a><a href="#">常见问题</a><a href="#">网站地图</a><a href="#">联系我们</a><a href="#">企业入驻</a><a href="#">意见反馈</a></div>
            <div class="p5">Copyright 2015 广州国健医药咨询服务有限公司<br>
			版权所有   粤ICP备11016031号-4</div>  
        </li>
        <li class="last">
        	<div class="p6"><a href="#"><p>新浪微博</p><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/images/ysd_7.jpg"></a></div>      
            <div class="p6"><a href="#"><p>微信</p><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/resource/images/ysd_8.jpg"></a></div>
            <div class="clear"></div>
        </li>
        <div class="clear"></div>
        </ul>
    </div>
</div>
</body>
</html>
<?php }} ?>
