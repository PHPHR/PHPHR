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
class payment_controller extends user{
	function index_action(){
		$rows=$this->obj->DB_select_all("bank");
		$this->yunset("rows",$rows);
		if($_COOKIE['usertype']!='1' || $this->uid==''){
			$this->ACT_msg("index.php","非法操作！"); 
		}else{
			$order=$this->obj->DB_select_once("company_order","`uid`='".$this->uid."' and `id`='".(int)$_GET['id']."' and `order_state`='1'");
			if(empty($order)){
				$this->ACT_msg("index.php","该订单已完成支付！"); 
			}else{
				$this->yunset("order",$order);
				$this->public_action();
				$this->yunset("comstyle","../app/template/member/com");
				$this->user_tpl('payment');
			}
		}
	}	
	function paybank_action(){
		$order=$this->obj->DB_select_once("company_order","`id`='".(int)$_POST['oid']."' and `uid`='".$this->uid."'");
		if($order['id']){ 
			$company_order="`order_type`='bank',`order_state`='3',`order_remark`='".$_POST['order_remark']."'";
			if($_POST['is_invoice']=='1'&&$this->config['sy_com_invoice']=='1'){
				$company_order.=",`is_invoice`='".intval($_POST['is_invoice'])."'";
				$this->add_invoice_record($_POST,$order['order_id'],$order['id']);
			}
			$this->obj->DB_update_all("company_order",$company_order,"`order_id`='".$order['order_id']."'");
			$this->ACT_layer_msg("操作成功，请等待管理员审核！",9,"index.php?c=paylist");
		}else{
			$this->ACT_layer_msg("非法操作！",8,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>