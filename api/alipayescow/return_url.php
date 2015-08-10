<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 */

error_reporting(0);
require_once("class/alipay_notify.php");
require_once("alipay_config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/config/db.config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/data/plus/config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/app/include/mysql.class.php");
$db = new mysql($db_config['dbhost'], $db_config['dbuser'], $db_config['dbpass'], $db_config['dbname'], ALL_PS, $db_config['charset']);



?>
<!DOCTYPE HTML>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	if(!preg_match('/^[0-9]+$/', $_GET['out_trade_no'])){die;}
	//交易状态
	$trade_status = $_GET['trade_status'];

	$dingdan           = $_GET['out_trade_no'];    //获取订单号

    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		
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

			}else if($order['type']=='2'&&$order['integral']){//充值积分
				mysql_query("update `".$db_config[def].$table."` set `integral`=`integral`+'".$order['integral']."'".$tvalue." where `uid`='".$order["uid"]."'");
				mysql_query("INSERT INTO `".$db_config[def]."company_pay`  SET `order_id`='".$order['order_id']."',`order_price`='".$order['integral']."',`pay_time`='".time()."',`pay_state`='2',`com_id`='".$order["uid"]."',`pay_remark`='"."购买".$config['integral_pricename']."',`type`='1',`pay_type`='2',`did`='".$config['did']."'");
			}
			mysql_query("update `".$db_config[def]."company_order` set `order_state`='2',`order_bank`='alipay' where `id`='".$order['id']."'");
		}
    }else {
      echo "trade_status=".$_GET['trade_status'];
    }
	echo "支付成功";
}else {

    echo "支付失败";
}
?>
        <title>支付宝纯担保交易接口</title>
	</head>
    <body>
    </body>
</html>