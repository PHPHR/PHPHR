<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class zph_controller extends common{  
	function zph_tpl($tpl){
		$this->yuntpl(array('default/zph/'.$tpl));
	}
	function Zphpublic_action(){
		if($this->config['sy_zph_web']=="2"){
			header("location:".Url('error'));
		}
	}
}
?>