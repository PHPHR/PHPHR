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
class topic_controller extends ask_controller{  
	function index_action(){ 
		$M=$this->MODEL('ask'); 
		$recom=$M->RecomFriend(array('iscert'=>'1',"`pic`<>''","uid"=>$this->uid),array('orderby'=>'rand()','limit'=>12,"field"=>"`uid`,`nickname`,`pic`"));
		$this->yunset("navtype","topic"); 
		$this->yunset("recom",$recom);
		$this->seo("ask_topic");
		$this->ask_tpl('topic');
	}


}
?>