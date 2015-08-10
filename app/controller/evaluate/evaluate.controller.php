<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class evaluate_controller extends common{ 
	function evaluate_tpl($tpl){
		$this->yuntpl(array('default/evaluate/'.$tpl));
	}
	
	function imgWebUrl($imgPath){
		return $this->config['sy_weburl']."/".$imgPath;
	}	
	
	function create_uuid($prefix = "yun"){
		$str = md5(uniqid(mt_rand(), true));   
		$uuid  = substr($str,0,12);   
		return $prefix.$uuid; 
	}	
}
?>