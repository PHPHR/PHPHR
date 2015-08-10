<?php
/* *
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
*/
class buysave_controller extends company
{
	function index_action()
	{
		$statis=$this->company_satic();
		if($_POST['type']=='pl'){
			$integral=$this->config['integral_com_comments']*intval($_POST['time']);
		}
		if($statis['integral']<$integral){
			$this->ACT_layer_msg("你的".$this->config['integral_pricename']."不足，请先充值！",8,"index.php?c=pay");
		}

		if($_POST['type']=='pl'){
			$this->company_invtal($this->uid,$integral,false,"购买企业评论管理",true,2,'integral',16);
			$company=$this->obj->DB_select_once("company","`uid`='".$this->uid."'","`pl_time`");
			if($company['pl_time']>time()){
				$pl_time=$company['pl_time']+86400*30*$_POST['time'];
			}else{
				$pl_time=time()+86400*30*intval($_POST['time']);
			}
			$oid=$this->obj->update_once("company",array("pl_time"=>$pl_time),array("uid"=>$this->uid));
			if($oid){
				$this->obj->member_log("购买评论管理");
				$this->ACT_layer_msg("您已购买成功！",9,"index.php");
			}else{
 				$this->ACT_layer_msg("购买失败，请稍后再试！",8,$_SERVER['HTTP_REFERER']);
			}
		}
	}
}
?>