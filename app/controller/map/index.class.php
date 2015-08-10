<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class index_controller extends map_controller{ 
	function index_action(){   
		$this->yunset($this->MODEL('cache')->GetCache(array('job','com','city','hy')));
		if($_GET[r]<500){
			$zoom=15;
		}elseif($_GET[r]>=500 && $_GET[r]<5000){
			$zoom=13;
		}else{
			$zoom=11;
		}
		$this->yunset("zoom",$zoom);
		$this->yunset("getinfo",$_GET);
		$this->seo("map");
		$this->map_tpl('index');
	} 
}
?>