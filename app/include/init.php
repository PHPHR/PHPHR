<?php
/*
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
 */ 
if($config['sy_wap_jump']=='1'){
	$uachar = '/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i';
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	if((preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap')){		
		$Loaction = $config['sy_weburl'].'/wap/'; 
		if (!empty($Loaction)){
            header('Location: '.$Loaction);exit;
		}
	}
}

$var=@explode('-',str_replace('/','-',$_GET['yunurl']));
foreach($var as $p){
	$param=@explode('_',$p);
	$_GET[$param[0]]=$param[1];
}
unset($_GET['yunurl']);

if($_GET['c'] && !ereg('^[0-9a-zA-Z\_]*$',$_GET['c'])){
	$_GET['c'] = 'index';
}
if($_GET['a'] && !ereg('^[0-9a-zA-Z\_]*$',$_GET['c'])){
	$_GET['a'] = 'index';
}
$ControllerName = $_GET['c'];
$ActionName = $_GET['a'];
if($ControllerName=='')	$ControllerName='index';
if($ActionName=='')	$ActionName = 'index';

$ControllerName = $_GET['c'];

$ActionName = $_GET['a'];

if($ControllerName=='')	$ControllerName='index';

if($ActionName=='')	$ActionName = 'index';


global $ModuleName,$DirName;

if($config['sy_'.$ModuleName.'_web']==2){
    echo '此模块未开启！';die;
}

$ControllerPath=APP_PATH.'app/controller/'.$ModuleName.'/';
require(APP_PATH.'app/public/common.php');

if(file_exists($ControllerPath.$ModuleName.'.controller.php')){
    require($ControllerPath.$ModuleName.'.controller.php');
}

if(file_exists($ControllerPath.$ControllerName.'.class.php')){
    require($ControllerPath.$ControllerName.'.class.php');
}else{
    $ActionName=$ControllerName;$ControllerName='index';
    if(!file_exists($ControllerPath.$ControllerName.'.class.php')){
        echo '此模块不存在！';die;
    }else{
        require($ControllerPath.'index.class.php');
    }
}

if($ModuleName=='siteadmin'){$model='admin';}else{$model='index';}


$conclass=$ControllerName.'_controller';

$actfunc=$ActionName.'_action';

$views=new $conclass($phpyun,$db,$db_config['def'],$model,$ModuleName);
$views->m=$ModuleName;
if(!method_exists($views,$actfunc)){
	$views->DoException();
}
$views->$actfunc();
?>