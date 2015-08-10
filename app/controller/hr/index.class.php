<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class index_controller extends common{
	function index_action()
	{
		if($this->config['sy_gjx_web']=="2")
		{
			header("location:".Url('error'));
		}
		$this->seo("hrindex");
		$this->yun_tpl(array('index'));
	}
	function list_action()
	{
		if($this->config['sy_gjx_web']=="2")
		{
			header("location:".Url('error'));
		}
		$this->yunset("keyword",$_GET['key']);
		$this->yunset("id",$_GET['id']);
		$Hr=$this->MODEL("hr");
		$class=$Hr->GetToolboxClassOne(array("id"=>(int)$_GET['id']));
		$this->yunset("class",$class);
		if($_GET['key'])
		{
			$data['hr_class']=$_GET['key'];
		}else{
			$data['hr_class']=$class['name'];
		}
		$this->data=$data;
		$this->seo("hrlist");
		$this->yun_tpl(array('list'));
	}
	function ajax_action(){
		if($_POST['id']){
            $ID=(int)$_POST['id'];
			$Hr=$this->MODEL("hr");
			$Hr->UpdateToolboxDoc(array("`downnum`=`downnum`+1"),array("id"=>$ID));
			$row=$Hr->GetToolboxDocOne(array("id"=>$ID));
			echo $this->config['sy_weburl'].$row['url'];die;
		}
	}
}
?>
