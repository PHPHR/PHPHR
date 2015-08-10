<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class index_controller extends zph_controller{ 
	function index_action(){ 
		$this->Zphpublic_action();
		$this->seo("zph"); 
		$this->zph_tpl('index');
	}  
    function review_action(){ 
		$this->Zphpublic_action();
		$this->seo("zph"); 
		$this->zph_tpl('review');
	}  
}
?>