<?php
error_reporting(0);

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");

require_once(dirname(dirname(dirname(__FILE__)))."/data/plus/config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/config/db.config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/app/include/mysql.class.php");
$db = new mysql($db_config['dbhost'], $db_config['dbuser'], $db_config['dbpass'], $db_config['dbname'], ALL_PS, $db_config['charset']);

$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
	$out_trade_no = $_GET['out_trade_no'];

	$trade_no = $_GET['trade_no'];

	$result = $_GET['result'];

	$out_trade_no = $_GET['out_trade_no'];

	$trade_no = $_GET['trade_no'];

	$result = $_GET['result'];
    $dingdan           = $out_trade_no; 
    $total_fee         = $_GET['total_fee'];
    $sOld_trade_status = "0";
	if(!is_numeric()){

		echo "订单号格式不正确";die;
	}
	if(!preg_match('/^[0-9]+$/', $dingdan)){die;}

    if(($result == 'TRADE_FINISHED') || ($result == 'TRADE_SUCCESS') || ($result == 'success') ) {

		$select=$db->query("select  * from `".$db_config[def]."company_order` where `order_id`='$dingdan'");

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
			}else if($order['type']=='2'&&$order['integral']){
				mysql_query("update `".$db_config[def].$table."` set `integral`=`integral`+'".$order['integral']."'".$tvalue." where `uid`='".$order["uid"]."'");
				mysql_query("INSERT INTO `".$db_config[def]."company_pay`  SET `order_id`='".$order['order_id']."',`order_price`='".$order['integral']."',`pay_time`='".time()."',`pay_state`='2',`com_id`='".$order["uid"]."',`pay_remark`='"."购买".$config['integral_pricename']."',`type`='1',`pay_type`='2',`did`='".$config['did']."'");
			}else if($order['type']=='5')
			{
				$value.="`job_num`='".$row['job_num']."',";
				$value.="`down_resume`='".$row['resume']."',";
				$value.="`invite_resume`='".$row['interview']."',";
				$value.="`editjob_num`='".$row['editjob_num']."',";
				$value.="`breakjob_num`='".$row['breakjob_num']."',";
				$value.="`all_pay`=`all_pay`+'".$order["order_price"]."'";
				mysql_query("update `".$db_config[def].$table."` set ".$value." where `uid`='".$order['uid']."'");
			}
			mysql_query("update `".$db_config[def]."company_order` set `order_state`='2' where `id`='".$order['id']."'");
		}
    }
    else {
		echo '<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>支付宝即时到账交易接口</title>
	</head>
    <body>'."trade_status=".$_GET['trade_status'].'</body></html>';die;
    }
}
else {
	echo "验证失败";die;
}
if(!($config['sy_wapdomain'])){
	$wapdomain=$config['sy_weburl'].'/'.$config['sy_wapdir'];
}else{
	$wapdomain=$config['sy_wapdomain'];
}
$Loaction=$wapdomain."/member/index.php?c=pay";
header("Location:".$Loaction);
?>