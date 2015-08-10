<?php


error_reporting(0);
require_once("class/alipay_notify.php");
require_once("alipay_config.php");

require_once(dirname(dirname(dirname(__FILE__)))."/config/db.config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/data/plus/config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/app/include/mysql.class.php");
$db = new mysql($db_config['dbhost'], $db_config['dbuser'], $db_config['dbpass'], $db_config['dbname'], ALL_PS, $db_config['charset']);

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	if(!preg_match('/^[0-9]+$/', $_POST['out_trade_no'])){die;}

    //验证成功
    //获取支付宝的反馈参数
    $dingdan           = $_POST['out_trade_no'];	    //获取支付宝传递过来的订单号
	$sql=$db->query("select * from `".$db_config["def"]."company_order` where `order_id`='".$dingdan."'");
    $row=mysql_fetch_array($sql);
	$sOld_trade_status =$row['order_state'];
	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
	//已提交订单，但未付款，不做处理
		
        echo "success";		

    }
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功
		
		if($sOld_trade_status=="1"){
			$mselect=$db->query("select  `usertype` from `".$db_config[def]."member` where `uid`='".$row['uid']."'");
			$member=mysql_fetch_array($mselect);
			if($member['usertype']=='1'){
				$table='member_statis';
			}else if($member['usertype']=='2'){
				$table='company_statis'; 
				$tvalue=",`all_pay`=`all_pay`+'".$row["order_price"]."'";
			}
			if($row['type']=="1"&&$row['rating']&&$member['usertype']!='1'){//购买会员
				$select=$db->query("select * from `".$db_config["def"]."company_rating` where `id`='".$row["rating"]."'");
				$comuid=mysql_fetch_array($select);
				$value="`rating`='".$comuid["id"]."',";
				$value.="`rating_name`='".$comuid["name"]."',"; 
				$value.="`rating_type`='".$comuid['type']."',";
				if($comuid['service_time']>0){
					$viptime=time()+$comuid['service_time']*86400;
				}else{
					$viptime=0;
				}
				$value.="`vip_etime`='".$viptime."',";
				$value.="`all_pay`=`all_pay`+'".$row["order_price"]."',"; 
					$value.="`job_num`=".$comuid["job_num"].",";
					$value.="`down_resume`=".$comuid["resume"].",";
					$value.="`invite_resume`=".$comuid["interview"].",";
					$value.="`editjob_num`=".$comuid["editjob_num"].",";
					$value.="`breakjob_num`=".$comuid["breakjob_num"]."";
				mysql_query("update `".$db_config["def"].$table."` SET ".$value." where `uid`='".$row["uid"]."'");

			}else if($row['type']=='2'&&$row['integral']){//充值积分 
				mysql_query("update `".$db_config[def].$table."` set `integral`=`integral`+'".$row['integral']."'".$tvalue." where `uid`='".$row["uid"]."'");
			}else if($row['type']=='3'||$row['type']=='4'){//银行转账
				mysql_query("update `".$db_config[def].$table."` set `pay`=`pay`+'".$row["order_price"]."'".$tvalue." where `uid`='".$row["uid"]."'");
			}
			@file_get_contents($alipaydata["sy_weburl"]."/index.php?m=ajax&c=paypost&dingdan=".$row[order_id]);
			mysql_query("update `".$db_config["def"]."company_order` set order_state='2',`order_bank`='alipay' where `order_id`='$row[order_id]'");
			if($sOld_trade_status < 1) {
				//根据订单号更新订单，把订单处理成交易成功
			}
			echo "success";

			//调试用，写文本函数记录程序运行情况是否正常
			//log_result("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}


    }
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {//该判断表示卖家已经发了货，但买家还没有
	
        echo "success";
    }
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {//该判断表示买家已经确认收货，这笔交易完成
		
	
		
			
        echo "success";

      
    }
    else {
		//其他状态判断
        echo "success";

    }

	
}
else {

    echo "fail";

}
?>