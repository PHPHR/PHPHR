<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class index_controller extends common{
	function index_action(){ 

		include LIB_PATH."datacall.class.php";
		$call= new datacall("data/plus/data/",$this->obj);
		$row=$call->get_data($_GET[id]);
		$row=str_replace("\n","",$row);
		$row=str_replace("\r","",$row);
		$row=str_replace("'","\'",$row);
		echo "document.write('$row');";
	}
	
}
?>