<?php
/* *
* $Author ��Pari�����Ŷ�, ��ϵ: QQ 280913284
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
			$this->ACT_msg("index.php","��̨��û������ת�ʹ��ܣ�����ϵ����Ա��");
		}
		if(isset($_POST['banksub']))
		{
			$remark="������У�".$_POST['bankname']."�� �տ��ˣ�".$_POST['bank_user']."�� ���лص���".$_POST['bank_odd']."�� ��ע��".$_POST['bank_remark'];
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
				$this->obj->member_log("�ύ����ת�˶���ID".$dingdan);
 				$this->ACT_layer_msg("�����ύ�ɹ�����ȴ�����Աȷ�ϣ�",9,"index.php?c=bank");
			}
		}
		$this->public_action();
		$this->yunset("js_def",4);
		$this->com_tpl('bank');
	}
}
?>