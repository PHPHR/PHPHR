<?php
/*
* $Author ��Pari�����Ŷ�, ��ϵ: QQ 280913284
*
*
 */
class article_controller extends common{ 
	function news_tpl($tpl){
		$this->yuntpl(array('default/article/'.$tpl));
	}
}
?>