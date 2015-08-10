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

include(dirname(__FILE__).'/global.php');

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

if($config['webcache']=='1'){
	include_once(LIB_PATH.'web.cache.php');
	$cache=new Phpyun_Cache('./cache',DATA_PATH,$config['webcachetime']);
	$cache->read_cache();
}

$var=@explode('-',str_replace('/','-',$_GET['yunurl']));
foreach($var as $p){
	$param=@explode('_',$p);
	$_GET[$param[0]]=$param[1];
}
unset($_GET['yunurl']);

if($_GET['m'] && !ereg('^[0-9a-zA-Z\_]*$',$_GET['c'])){
	$_GET['m'] = 'index';
}
$ModuleName = $_GET['m'];
if($ModuleName=='')	$ModuleName='index';

include(LIB_PATH.'init.php');
if($config['webcache']=='1'){
	$cache->CacheCreate();
}
?>