<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class map_controller extends common{ 
	function map_tpl($tpl){
		$this->yuntpl(array('default/map/'.$tpl));
	}
}
?>