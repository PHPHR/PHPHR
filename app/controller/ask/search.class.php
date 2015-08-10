<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class search_controller extends ask_controller{ 
	function index_action(){
		$M=$this->MODEL('ask'); 
 		$hotuser=$M->GetHotUser(array("`add_time`>'".strtotime("-30 day")."'"),array('groupby'=>"uid","orderby"=>'num',"desc"=>'desc',"limit"=>10,"field"=>"uid,count(id) as num,sum(support) as support"));
		if(trim($_GET['keyword'])){$this->addkeywords(12,trim($_GET['keyword']));}
 		$this->atnask($M);
 		$this->hotclass();
		$this->yunset("getinfo",$_GET);   
		$this->yunset("hotuser",$hotuser);   
		$this->yunset("navtype","topic");
		$this->seo('ask_search');
		$this->ask_tpl('search');
	}
}
?>