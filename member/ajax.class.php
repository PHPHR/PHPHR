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
class ajax_controller extends common{
    function default_resume_action(){
		$eid=(int)$_POST['eid'];
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=1){
			echo 0;die;
		}else{
			$nid=$this->obj->DB_update_all("resume","`def_job`='".$eid."'","`uid`='".$this->uid."'");
			if($nid){
				$this->obj->DB_update_all("resume_expect","`defaults`='0'","`uid`='".$this->uid."' and `id`<>'".$eid."'");
				$this->obj->DB_update_all("resume_expect","`defaults`='1'","`uid`='".$this->uid."' and `id`='".$eid."'");
				$this->obj->member_log("设置默认简历");
			}
			echo $nid?1:2;
		}
	}
	function order_type_action(){
		if($this->uid  && $this->username && $_COOKIE['usertype']==2){
			$nid=$this->obj->DB_update_all("company_order","`order_type`='".(int)$_POST['paytype']."'","`order_id`='".(int)$_POST['order']."'");
			if($nid){
				$this->obj->member_log("修改订单付款类型");
			}
			echo $nid?1:2;
		}
	}
	function ajax_ltjobone_action(){
		include(PLUS_PATH."ltjob.cache.php");
		$jobid=$_POST['str'];
		$data="";
		if(is_array($ltjob_type[$jobid])){
			foreach($ltjob_type[$jobid] as $v){
				$data.="<li> <a onclick=\"selectjobtwo('".$v."','jobtwo','".$ltjob_name[$v]."','jobtype');\" href=\"javascript:;\"> ".$ltjob_name[$v]."</a> </li>";
			}
		}
		echo $data;
	}
	function delupload_action(){
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=2){
			echo 0;die;
		}else{
			$dir=$_POST[str][0];
			$isuser = $this->obj->DB_select_once("company_show","`picurl`='$dir'");
			if($isuser['uid']==$this->uid){
				echo unlink_pic(".".$dir);
			}else{
				echo 0;die;
			}
		}
	}
	function emailcert_action(){
		session_start();
		if(md5($_POST['authcode'])!=$_SESSION['authcode']){
			echo 4;die;
		}
		if(!$this->uid || !$this->username){
			echo 0;die;
		}else{
			if($this->config['sy_smtpserver']=="" || $this->config['sy_smtpemail']=="" || $this->config['sy_smtpuser']==""){
				echo 3;die;
			}
			if($this->config['sy_email_cert']=="2"){
				echo 2;die;
			}
			$email=$_POST['email'];
			$randstr=rand(10000000,99999999);
			$sql['status']=0;
			$sql['step']=1;
			$sql['check']=$email;
			$sql['check2']=$randstr;
			$sql['ctime']=mktime();
			$row=$this->obj->DB_select_once("company_cert","`uid`='".$this->uid."' and type='1'");
			if(is_array($row)){
				$where['uid']=$this->uid;
				$where['type']='1';
				$this->obj->update_once("company_cert",$sql,$where);
				$this->obj->member_log("更新邮箱认证");
			}else{
				$sql['uid']=$this->uid;
				$sql['type']=1;
				$this->obj->insert_into("company_cert",$sql);
				$this->obj->member_log("添加邮箱认证");
			}
			$base=base64_encode($this->uid."|".$randstr."|".$this->config['coding']);
			$fdata=$this->forsend(array('uid'=>$this->uid,'usertype'=>$this->usertype));
			$data['uid']=$this->uid;
			$data['name']=$fdata['name'];
 			$data['type']="cert";
			$data['email']=$email;
			$data['url']="<a href='".Url("qqconnect",array('c'=>'cert','id'=>$base),"1")."'>点击认证</a>";
			$data['date']=date("Y-m-d");
			$this->send_msg_email($data);
			echo "1";die;
		}
	}
    function mobliecert_action()
    {
		if(!$this->config["sy_msguser"] || !$this->config["sy_msgpw"] || !$this->config["sy_msgkey"]){
			echo 4;die;
		}
		if(!$this->uid || !$this->username){
			echo 0;die;
		}else{
			$shell=$this->GET_user_shell($this->uid,$_COOKIE['shell']);
			if(!is_array($shell)){echo 2;die;}
			$moblie=$_POST[str];
			$randstr=rand(100000,999999);
			setcookie("moblie_code",$randstr,time()+120, "/");
			$sql['status']=0;
			$sql['step']=1;
			$sql['check']=$moblie;
			$sql['check2']=$randstr;
			$sql['ctime']=mktime();
			$row=$this->obj->DB_select_once("company_cert","`uid`='".$this->uid."' and type='2'");
			if(is_array($row)){
				$where['uid']=$this->uid;
				$where['type']='2';
				$this->obj->update_once("company_cert",$sql,$where);
				$this->obj->member_log("更新手机认证");
			}else{
				$sql['uid']=$this->uid;
				$sql['type']=2;
				$this->obj->insert_into("company_cert",$sql);
				$this->obj->member_log("添加手机认证");
			}
			if($this->config['sy_msg_cert']=="2"){
				echo 3;die;
			}else{
				$fdata=$this->forsend(array('uid'=>$this->uid,'usertype'=>$this->usertype));
				$data['uid']=$this->uid;
				$data['name']=$fdata['name'];
				$data['type']="cert";
				$data['moblie']=$moblie;
				$data['code']=$randstr;
				$data['date']=date("Y-m-d");
				$status=$this->send_msg_email($data);
				echo $status;die;
			}
		}
	}
    function getzphcom_action(){
		if(!$_GET['jobid']){
			$arr['status']=0;
			$arr['content']=iconv("gbk","utf-8","您还没有职位，<a href='".Url("login",array(),"1")."'>请先登录</a>");
		}else{
			$jobid=(int)$_GET['jobid'];
			$row=$this->obj->DB_select_all("company_job","`id`='".$jobid."'  and `uid`='".$this->uid."' and `r_status`<>'2' and `status`<>'1'","`name`");
			$zhaopinhui=$this->obj->DB_select_once("zhaopinhui","`id`='".intval($_GET['zid'])."'","`title`,`address`,`starttime`,`endtime`");
			foreach($row as $v){
				$data[]=$v['name'];
			}
			$cname=@implode('、',$data);
			$arr['status']=1;
			$arr['content']=iconv("gbk","utf-8",$cname);
			$arr['title']=iconv("gbk","utf-8",$zhaopinhui['title']);
			$arr['address']=iconv("gbk","utf-8",$zhaopinhui['address']);
			$arr['starttime']=iconv("gbk","utf-8",$zhaopinhui['starttime']);
			$arr['endtime']=iconv("gbk","utf-8",$zhaopinhui['endtime']);
		}
		echo json_encode($arr);
	}
    function Refresh_job_action(){
		if($_POST['ids']){
			$num=count($_POST['ids']);
		}else{
			$num=$this->obj->DB_select_num("company_job","`state`='1' and `uid`='".$this->uid."'");
		}
		if($num==0){
			echo "您暂无正常职位！";die;
		}
		$statis=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'");


		if($statis['vip_etime']>time() || $statis['vip_etime']=="0"){
			if($statis['rating_type']==1){
				if($statis['breakjob_num']>=$num){

					$value="`breakjob_num`='".($statis['breakjob_num']-$num)."'";
					$this->obj->DB_update_all("company_statis",$value,"`uid`='".$this->uid."'");
				}else{
					if($this->config['com_integral_online']=="1"){
						$integral=$this->config['integral_jobefresh']*($num-$statis['breakjob_num']);
						if($statis['integral']<$integral){
							echo "会员刷新职位数、".$this->config['integral_pricename']."均不足！";die;
						}else{
							$value="`breakjob_num`='0',`integral`=`integral`-$integral";
							$this->obj->DB_update_all("company_statis",$value,"`uid`='".$this->uid."'");
							$this->insert_company_pay($integral,2,$this->uid,'批量刷新职位',1,8);
						}
					}else{
						echo "会员刷新职位数不足！";die;
					}
				}
			}
		}else{
			if($this->config['com_integral_online']=="1"){
				$integral=$this->config['integral_jobefresh']*($num-$statis['breakjob_num']);
				if($statis['integral']<$integral){
					echo "会员刷新职位数、".$this->config['integral_pricename']."均不足！";die;
				}else{
					$value="`breakjob_num`='0',`integral`=`integral`-$integral";
					$this->obj->DB_update_all("company_statis",$value,"`uid`='".$this->uid."'");
					$this->insert_company_pay($integral,2,$this->uid,'批量刷新职位',1,8);
				}
			}else{
				echo "会员刷新职位数不足！";die;
			}
		}
		if($_POST['ids']!=""){
			$ids=pylode(",",$_POST['ids']);
			$nid=$this->obj->DB_update_all("company_job","`lastupdate`='".time()."'","`id` in (".$ids.") and `uid`='".$this->uid."'");
		}else{
			$nid=$this->obj->DB_update_all("company_job","`lastupdate`='".time()."'","`status`='1' and `uid`='".$this->uid."'");
		}
		$this->obj->DB_update_all("company","`jobtime`='".time()."'","`uid`='".$this->uid."'");
		if($nid){
			$this->obj->member_log("批量刷新职位",1,4);
			echo 1;die;
		}else{
			echo "刷新失败！";die;
		}
	}
    function ajax_city_action(){
		if($_POST['ptype']=='city'){
			include(PLUS_PATH."city.cache.php");
			if(is_array($city_type[$_POST['id']])){
				$data.="<ul>";
				foreach($city_type[$_POST['id']] as $v){
					if($_POST['gettype']=="citys"){
						$data.='<li myselect='.$v.'><a href="javascript:;" >'.$city_name[$v].'</a></li>';
					}else{
						$data.='<li myselect='.$v.'><a href="javascript:;" >'.$city_name[$v].'</a></li>';
					}
				}
				$data.="</ul>";
			}
		}else{
			include(PLUS_PATH."job.cache.php");
			if(is_array($job_type[$_POST['id']])){
				$data.="<ul>";
				foreach($job_type[$_POST['id']] as $v){
					if($_POST['gettype']=="job1_son"){
						$data.='<li><a href="javascript:;" >'.$job_name[$v].'</a></li>';
					}else{
						$data.='<li><a href="javascript:;" >'.$job_name[$v].'</a></li>';
					}
				}
				$data.="</ul>";
			}
		}
		echo $data;
	}
	function job_content_action(){
		$info=$this->obj->DB_select_once("job_class","`id`='".(int)$_POST['id']."'");
		echo $info['content'];die;
	}
	function get_jobclass_action(){
		if($_POST['name']){
			include(PLUS_PATH."job.cache.php");
			$name=$this->stringfilter($_POST['name']);
			$r=$this->locoytostr($job_name,$name);
			if(is_array($r)&&$content){
				$arr=array();
				foreach($r as $v){
					foreach($content as $val){
						if($v==$val){
							$arr[]=$val;
						}
					}
				}
				if($arr&&is_array($arr)){
					foreach($arr as $v){
						if(in_array($v,$content)){
							$html.="<a href=\"javascript:select_job('".$v."');\"> ".$job_name[$v]." </a>";
						}
					}
					echo $html."##".$job_name[$arr[0]];die;
				}
			}
		}
	}
	function locoytostr($arr,$str,$locoy_rate="50"){
		$str_array=$this->tostring($str);
		foreach($arr as $key =>$list){
			$h=0;
			foreach($str_array as $val){
				if(substr_count($list,$val))$h++;
			}
			$categoryname_array=$this->tostring($list);
			$j=round($h/count($categoryname_array)*100,2);
			$rows[$j]=$key;
		}
		krsort($rows);
		$i=0;
		foreach($rows as $k =>$v){
			if ($k>=$locoy_rate && $i<3){
				$job[]=$v;
				$i++;
			}
		}
		return $job;
	}
	function tostring($string){
		$length=strlen($string);
		$retstr='';
		for($i=0;$i<$length;$i++) {
			$retstr[]=ord($string[$i])>127?$string[$i].$string[++$i]:$string[$i];
		}
		return $retstr;
	}
	function ajax_ltjob_action()
	{
		include(PLUS_PATH."ltjob.cache.php");
		$jobid=$_POST['id'];
		if(is_array($ltjob_type[$jobid]))
		{
			$data.="<div class=\"m_post_job01\"><ul>";
			foreach($ltjob_type[$jobid] as $v)
			{
				$data.="<li><a href=\"javascript:check_select('".$v."','".$ltjob_name[$v]."','jobtwo');\"> ".$ltjob_name[$v]."</a></li>";
			}
			$data.="</ul></div>";
		}
		echo $data;
	}
	function getjoblist_action()
	{
		include(PLUS_PATH."job.cache.php");
		$data.='<option value="">--请选择--</option>';
		if(is_array($job_type[$_POST['id']])){
			foreach($job_type[$_POST['id']] as $v){
				$data.='<option value="'.$v.'">'.$job_name[$v].'</option>';
			}
		}
		echo $data;die;
	}
	function getcitylist_action()
	{
		include(PLUS_PATH."city.cache.php");
		$data.='<option value="">--请选择--</option>';
		if(is_array($city_type[$_POST['id']])){
			foreach($city_type[$_POST['id']] as $v){
				$data.='<option value="'.$v.'">'.$city_name[$v].'</option>';
			}
		}
		echo $data;die;
	}
}
?>