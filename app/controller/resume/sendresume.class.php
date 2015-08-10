<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class sendresume_controller extends resume_controller{
	function index_action(){
		if($_GET['id']){
			$M=$this->MODEL('resume');
			$id=(int)$_GET['id'];
			$user=$M->resume_select($id);
			$this->yunset("Info",$user);
		}
		$this->yun_tpl(array('sendresume'));
    }
}
?>