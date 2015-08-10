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
class wap_controller extends common{ 
	function waplayer_msg($msg,$url='1',$tm=2){
		$msg = preg_replace('/\([^\)]+?\)/x',"",str_replace(array("（","）"),array("(",")"),$msg));
		$layer_msg['msg']=$this->yun_iconv("gbk","utf-8",$msg); 
		$layer_msg['url']=$url;
		$layer_msg['tm']=$tm;
		$msg = json_encode($layer_msg);
		echo $msg;die;
	}
	
	function yun_iconv($in_charset,$out_charset,$str){
	    if(function_exists('mb_convert_encoding')){
	        return mb_convert_encoding($str,$out_charset,$in_charset);
	    }else if(function_exists('mb_convert_encoding')){
	        return iconv($in_charset,$out_charset,$str);
	    }else{
	        return $str;
	    }
	}
	function member_log($content,$opera='',$type=''){
		if($_COOKIE['uid']){
			$value="`uid`='".(int)$_COOKIE['uid']."',";
			$value.="`usertype`='".(int)$_COOKIE['usertype']."',";
			$value.="`content`='".$content."',";
			$value.="`opera`='".$opera."',";
			$value.="`type`='".$type."',";
			$value.="`ip`='".fun_ip_get()."',";
			$value.="`ctime`='".time()."'";
			$this->obj->DB_insert_once("member_log",$value);
		}
	}
}
?>