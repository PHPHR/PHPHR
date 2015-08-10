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
class pay_controller extends user{
	function index_action(){
		$this->public_action();
		$this->user_tpl('pay');
	}
	function dingdan_action(){
		$price=(int)$_POST['price'];	
		if($price && $_POST['submit']){ 
			$integral=$price*$this->config['integral_proportion'];
			$dingdan=mktime().rand(10000,99999);
			$data['order_id']=$dingdan;
			$data['order_price']=$price;
			$data['order_time']=mktime();
			$data['order_state']="1";
			$data['integral']=$integral;
			$data['order_remark']=$_POST['remark'];
			$data['uid']=$this->uid;
			$data['type']=2;
			$id=$this->obj->insert_into("company_order",$data);
			if($id){
				$this->obj->member_log("下单成功 订单ID".$dingdan);
				$this->ACT_layer_msg("下单成功，请付款！",9,"index.php?c=payment&id=".$id);
			}else{
				$this->ACT_layer_msg("提交失败，请重新提交订单！",8,$_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->ACT_layer_msg("参数不正确，请正确填写！",8,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>