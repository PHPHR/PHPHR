<?php
/*
* $Author ��Pari�����Ŷ�, ��ϵ: QQ 280913284
*
*
 */
class index_controller extends article_controller{ 
	function index_action(){		
		$this->seo("news");
		$this->news_tpl('index');
	} 
}
?>