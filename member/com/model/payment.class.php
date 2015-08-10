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
class payment_controller extends company{
	function index_action(){
		$rows=$this->obj->DB_select_all("bank");
		$this->yunset("rows",$rows);
		$order=$this->obj->DB_select_once("company_order","`uid`='".$this->uid."' and `id`='".(int)$_GET['id']."' and `order_state`='1'");
		if(empty($order)){
			$this->ACT_msg("index.php","非法操作！");
		}else{
			$statis=$this->company_satic();
			$company=$this->obj->DB_select_once("company","`uid`='".$this->uid."'","`linkman`,`linktel`,`address`");
			$order_remark="我所汇款的银行：\n我汇入的帐号：\n汇款金额：\n汇款时间：\n其他：\n";
			if($company['linkman']==''||$company['linktel']==''||$company['address']==''){
				$company['link_null']='1';
			}
			$this->yunset("company",$company);
			$this->yunset("order",$order);
			$this->yunset("order_remark",$order_remark);
			$this->yunset("statis",$statis);
			$this->yunset("js_def",4);
			$this->public_action();
			$this->com_tpl('payment');
		}
	}
	function paybank_action(){
		$order=$this->obj->DB_select_once("company_order","`id`='".(int)$_POST['oid']."' and `uid`='".$this->uid."'");
		if($order['id']){
			$company_order="`order_type`='bank',`order_state`='3',`order_remark`='".$_POST['order_remark']."'";
			$this->obj->DB_update_all("company_order",$company_order,"`order_id`='".$order['order_id']."'");
			$this->ACT_layer_msg("操作成功，请等待管理员审核！",9,"index.php?c=paylog");
		}else{
			$this->ACT_layer_msg("非法操作！",8,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>