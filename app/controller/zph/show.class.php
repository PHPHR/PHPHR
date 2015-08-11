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
class show_controller extends zph_controller{ 
	function index_action(){   
		$this->Zphpublic_action();
		$id=(int)$_GET['id'];
		$M=$this->MODEL('zph');
		$row=$M->GetZphOnce(array("id"=>$id)); 
		$row["stime"]=strtotime($row['starttime'])-mktime();
		$row["etime"]=strtotime($row['endtime'])-mktime();
		$rows=$M->GetZphPic(array("zid"=>$id));
		$data['zph_title']=$row['title'];
		$data['zph_desc']=$this->GET_content_desc($row['body']);
		$this->data=$data;
		$this->yunset("Info",$row);
		$this->yunset("Image_info",$rows);
		$this->seo("zph_show");
		$this->zph_tpl('zphshow'); 
	} 
}
?>