<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class special_controller extends common{
	function spetpl($tpl){ 
		$this->yuntpl(array('default/special/'.$tpl));
	}
}
?>