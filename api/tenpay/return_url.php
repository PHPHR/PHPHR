<?php
/*
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
 */
//---------------------------------------------------------
//财付通即时到帐支付应答（处理回调）示例，商户按照此文档进行开发即可
//---------------------------------------------------------
error_reporting(0);
require_once ("./classes/PayResponseHandler.class.php");
require_once ("tenpay_data.php");

//引入本站数据
require_once(dirname(dirname(dirname(__FILE__)))."/config/db.config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/data/plus/config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/app/include/mysql.class.php");
$db = new mysql($db_config['dbhost'], $db_config['dbuser'], $db_config['dbpass'], $db_config['dbname'], ALL_PS, $db_config['charset']);

/* 密钥 */
$key =$tenpay[sy_tenpaycode];

/* 创建支付应答对象 */
$resHandler = new PayResponseHandler();
$resHandler->setKey($key);

//判断签名
if($resHandler->isTenpaySign()) {

	//交易单号
	$transaction_id = $resHandler->getParameter("transaction_id");

	//本站单号
	$sp_billno = $resHandler->getParameter("sp_billno");

	//金额,以分为单位
	$total_fee = $resHandler->getParameter("total_fee");

	//支付结果
	$pay_result = $resHandler->getParameter("pay_result");
	//类型
	$attach = $resHandler->getParameter("attach");

	if( "0" == $pay_result ) {

		//------------------------------
		//处理业务开始
		//------------------------------

		//注意交易单不要重复处理
		//注意判断返回金额
//处理本站信息开始
	if(!preg_match('/^[0-9]+$/',$sp_billno))
	{
		die;
	}
	$select=$db->query("select  * from `".$db_config[def]."company_order` where `order_id`='$sp_billno'");
	$order=mysql_fetch_array($select);
	if($order['order_state']!='2'&&$order['id']){
		$mselect=$db->query("select  `usertype` from `".$db_config[def]."member` where `uid`='".$order['uid']."'");
		$member=mysql_fetch_array($mselect);
		if($member['usertype']=='1'){
			$table='member_statis';
		}else if($member['usertype']=='2'){
			$table='company_statis';
			$tvalue=",`all_pay`=`all_pay`+'".$order["order_price"]."'";
		}
		if($order['type']=='1'&&$order['rating']&&$member['usertype']!='1'){
			$select_rating=$db->query("select * from `".$db_config[def]."company_rating` where `id`='".$order['rating']."'");
			$row=mysql_fetch_array($select_rating);
			$value="`rating`='".$row['id']."',";
			$value.="`rating_name`='".$row['name']."',";
			$value.="`rating_type`='".$row['type']."',";
			if($row['service_time']>0){
				$viptime=time()+$row['service_time']*86400;
			}else{
				$viptime=0;
			}
			$value.="`vip_etime`='".$viptime."',";
			$value.="`all_pay`=`all_pay`+'".$order["order_price"]."',";
				$value.="`job_num`='".$row['job_num']."',";
				$value.="`down_resume`='".$row['resume']."',";
				$value.="`invite_resume`='".$row['interview']."',";
				$value.="`editjob_num`='".$row['editjob_num']."',";
				$value.="`breakjob_num`='".$row['breakjob_num']."'";
			mysql_query("update `".$db_config[def].$table."` set ".$value." where `uid`='".$order['uid']."'");

		}else if($order['type']=='2'&&$order['integral']){//充值积分
			mysql_query("update `".$db_config[def].$table."` set `integral`=`integral`+'".$order['integral']."'".$tvalue." where `uid`='".$order["uid"]."'");
			mysql_query("INSERT INTO `".$db_config[def]."company_pay`  SET `order_id`='".$order['order_id']."',`order_price`='".$order['integral']."',`pay_time`='".time()."',`pay_state`='2',`com_id`='".$order["uid"]."',`pay_remark`='"."购买".$config['integral_pricename']."',`type`='1',`pay_type`='2',`did`='".$config['did']."'");
		}
		mysql_query("update `".$db_config[def]."company_order` set `order_state`='2' where `id`='".$order['id']."'");
	}
	@file_get_contents($tenpaydata["sy_weburl"]."/index.php?m=ajax&c=paypost&dingdan=".$sp_billno);
	mysql_query("update `".$db_config["def"]."company_order` set order_state='2',`order_bank`='bank' where `order_id`='$sp_billno'");

//处理本站信息结束




		//------------------------------
		//处理业务完毕
		//------------------------------

		//调用doShow, 打印meta值跟js代码,告诉财付通处理成功,并在用户浏览器显示$show页面.
		$show = $tenpay[sy_weburl]."/app/tenpay/show.php";
		$resHandler->doShow($show);

	} else {
		//当做不成功处理
		echo "<br/>" . "支付失败" . "<br/>";
	}

} else {
	echo "<br/>" . "认证签名失败" . "<br/>";
}

//echo $resHandler->getDebugInfo();

?>