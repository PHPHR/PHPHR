<?php
/* *
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
*/
class bank_controller extends company
{
	function index_action()
	{
		$rows=$this->obj->DB_select_all("bank");
		$this->yunset("rows",$rows);
		if($this->config['bank']!=1 || empty($rows))
		{
			$this->ACT_msg("index.php","后台还没有银行转帐功能，请联系管理员！");
		}
		if(isset($_POST['banksub']))
		{
			$remark="汇款银行：".$_POST['bankname']."； 收款人：".$_POST['bank_user']."； 银行回单：".$_POST['bank_odd']."； 汇款备注：".$_POST['bank_remark'];
			$dingdan=mktime().rand(10000,99999);
			$order_bank=$_POST['bankname']."@%".$_POST['bank_user']."@%".$_POST['bank_odd'];
			$data['uid']=$this->uid;
			$data['order_id']=$dingdan;
			$data['order_price']=$_POST['bank_price'];
			$data['order_type']="bank";
			$data['order_time']=time();
			$data['order_state']=3;
			$data['order_remark']=$remark;
			$data['order_bank']=$order_bank;
			$data['type']=3;
			$company_bank=$this->obj->insert_into("company_order",$data);
			if($company_bank)
			{
				$this->obj->member_log("提交银行转账订单ID".$dingdan);
 				$this->ACT_layer_msg("您已提交成功，请等待管理员确认！",9,"index.php?c=bank");
			}
		}
		$this->public_action();
		$this->yunset("js_def",4);
		$this->com_tpl('bank');
	}
}
?>