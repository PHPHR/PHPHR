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
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.2
 * 日期：2011-03-25

 */
error_reporting(0);
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
require_once(dirname(dirname(dirname(__FILE__)))."/config/db.config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/data/plus/config.php");
require_once(dirname(dirname(dirname(__FILE__)))."/app/include/mysql.class.php");
$db = new mysql($db_config['dbhost'], $db_config['dbuser'], $db_config['dbpass'], $db_config['dbname'], ALL_PS, $db_config['charset']);
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代

	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	if(!preg_match('/^[0-9]+$/', $_POST['out_trade_no'])){
		die;
	}
    $out_trade_no	= $_POST['out_trade_no'];	    //获取订单号
    $trade_no		= $_POST['trade_no'];	    	//获取支付宝交易号
    $total			= $_POST['price'];				//获取总价格
	$sql=$db->query("select * from `".$db_config["def"]."company_order` where `order_id`='$out_trade_no'");
    $row=mysql_fetch_array($sql);
	$sOld_trade_status = $row['order_state'];
	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {

	//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款

		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序

        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        logResult("没有付款");
    }
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
	    //该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货

		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序

        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        logResult("未发货");
    }
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
	//该判断表示卖家已经发了货，但买家还没有做确认收货的操作

		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序

        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
       logResult("未确认收货");
    }
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {
	//该判断表示买家已经确认收货，这笔交易完成

		//判断该笔订单是否在商户网站中已经做过处理（可参考“集成教程”中“3.4返回数据处理”）
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
				logResult($sql.$out_trade_no.$db_config["def"]);
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
				mysql_query("INSERT INTO `".$db_config[def]."company_order`  SET `order_id`='".$row['order_id']."',`order_price`='".$row['integral']."',`pay_time`='".time()."',`pay_state`='2',`com_id`='".$row["uid"]."',`pay_remark`='"."购买".$config['integral_pricename']."',`type`='1',`pay_type`='2',`did`='".$config['did']."'");
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
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常

    }
    else {
		//其他状态判断
        echo "success";

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>