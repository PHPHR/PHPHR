<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class list_controller extends article_controller{
	function index_action(){
		$M=$this->MODEL('article');
        $class=$M->GetNewsGroupOnce(array('id'=>(int)$_GET['nid']),array('field'=>"`name`"));
        $this->yunset("classname",$class['name']);
		
		$data['news_class']=$class['name'];
		$this->data=$data;
		$this->seo("newslist");
		$this->news_tpl('list');
	}
}
?>