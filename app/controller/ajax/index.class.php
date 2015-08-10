<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class index_controller extends common{
	function comindex_favjob_action(){
		if($_COOKIE['usertype']!=1){
			echo 0;die;
		}else if(!$this->uid || !$this->username ){
			echo 4;die;
		}else{
			$jobid=@explode(",",$_POST['codewebarr']);
			if(is_array($jobid)){
				$JobM=$this->MODEL("job");
				$M=$this->MODEL("userinfo");
				$historyM = $this->MODEL('history');
				foreach($jobid as $v){
					$row=$JobM->GetFavJobOne(array("uid"=>$this->uid,"job_id"=>(int)$v,"type"=>(int)$_POST['type']),array("field"=>"id"));
					if(empty($row)){
						$row=$JobM->GetComjobOne(array("id"=>(int)$v,"`r_status`<>'2'"),array("field"=>"name,com_name,uid"));
						$value['job_id']=$v;
						$value['com_name']=$row['com_name'];
						$value['job_name']=$row['name'];
						$value['com_id']=$row['uid'];
						$value['uid']=$this->uid;
						$value['datetime']=mktime();
						$value['type']=(int)$_POST['type'];
						$nid=$JobM->AddFavJob($value);
						$historyM->addHistory('favjob',$v);
						if($nid){
							$M->UpdateUserStatis(array("`fav_jobnum`=`fav_jobnum`+1"),array("uid"=>$this->uid),array("usertype"=>"1"));
							$state_content = "我收藏了职位 <a href=\"".Url("job",array('c'=>'comapply','id'=>$v))."\">".$row['jobname']."</a>";
							$this->addstate($state_content,2);
							$this->obj->member_log("我收藏了职位：".$row['jobname'],5);
						}
					}
				}
			}
			echo 1;die;
		}
	}
	function comindex_sqjob_action(){
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=1){
			echo 0;die;
		}else{
			$jobid=@explode(",",$_POST['codewebarr']);
			if(is_array($jobid)){
				$JobM=$this->MODEL("job");
				$M=$this->MODEL("userinfo");
				$historyM = $this->MODEL('history');
				foreach($jobid as $v){
					$row=$JobM->GetUseridJobOne(array("uid"=>$this->uid,"job_id"=>(int)$v),array("field"=>"`id`"));
					if(empty($row)){
						$row=$JobM->GetComjobOne(array("id"=>(int)$v,"`r_status`<>'2'"),array("field"=>"`uid`,`name`,`com_name`,`edate`,`link_type`"));
						if(is_array($row) && $row['edate']>time()){
							$value=array();
							$value['job_id']=$v;
							$value['com_name']=$row['com_name'];
							$value['job_name']=$row['name'];
							$value['com_id']=$row['uid'];
							$value['uid']=$this->uid;
							$value['eid']=(int)$_POST['eid'];
							$value['datetime']=time();
							$nid=$JobM->AddUseridJob($value);
							$historyM->addHistory('favjob',$v);
							if($nid){
								$JobM->UpdateComjob(array("`snum`=`snum`+1"),array("id"=>(int)$v));
								$M->UpdateUserStatis(array("`sq_job`=`sq_job`+1"),array("uid"=>$row['uid']),array("usertype"=>"2"));
								$M->UpdateUserStatis(array("`sq_jobnum`=`sq_jobnum`+1"),array("uid"=>$this->uid),array("usertype"=>"1"));
								$state_content = "我申请了职位 <a href=\"".Url("job",array('c'=>'comapply','id'=>(int)$v),"1")."\">".$row['name']."</a>";
								$this->addstate($state_content,2);
								$this->sqjobmsg($v,$row['uid']);
								if($row['link_type']=='1'){
									$ComM=$this->MODEL("company");
									$com=$ComM->GetCompanyInfo(array("uid"=>$row['uid']),array("`linkmail`"));
									$email=$com['linkmail'];
								}else{
									$job_link=$JobM->GetComjoblinkOne(array("jobid"=>(int)$_POST['jobid'],"is_email"=>"1"),array("field"=>"`email`"));
									$email=$job_link['linkmail'];
								}
								if($this->config["sy_smtpserver"]!="" && $this->config["sy_smtpemail"]!="" &&$this->config["sy_smtpuser"]!=""){
									if($email){
										$contents=file_get_contents($this->config[sy_weburl]."/index.php?m=resume&c=sendresume&job_link=1&id=".$_POST['eid']);
										$smtp = $this->email_set();
										$smtpusermail =$this->config['sy_smtpemail'];
										$sendid = $smtp->sendmail($email,$smtpusermail,"您收到一份新的求职简历！——".$this->config['sy_webname'],$contents);
									}
								}
								$sendid[] = $v;
								$this->obj->member_log("我申请了职位：".$row[0]['jobname'],6);
							}
						}
					}
				}
				if(!empty($sendid)){
					$Weixin=$this->MODEL('weixin');
					$Weixin->sendWxJob($this->uid,$sendid);
				}
			}
			echo 1;die;
		}
	}
	function sq_job_action(){
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=1){
			echo 0;die;
		}
		$JobM=$this->MODEL("job");
		$M=$this->MODEL("userinfo");
		$jobid=(int)$_POST['jobid'];
		$job=$JobM->GetComjobOne(array("id"=>$jobid,"`r_status`<>'2' and `status`<>'1'"),array("field"=>"`name`,`uid`,`edate`,`link_type`"));
		if(is_array($job)&&!empty($job)){
			if($job['edate']<time()){
				echo 5;die;
			}
	        $isblackname=$JobM->GetBlackOne(array("p_uid"=>$this->uid,"c_uid"=>$job['uid'],"usertype"=>"2"));
	        if(is_array($isblackname)){
	        	echo 4;die;
	        }
			$rows=$JobM->GetUseridJobOne(array("uid"=>$this->uid,"job_id"=>$jobid));
			if(is_array($rows)&&!empty($rows)){
				echo 3;die;
			}
			$value['job_id']=$jobid;
			$value['com_name']=yun_iconv("utf-8","gbk",$_POST['companyname']);
			$value['job_name']=yun_iconv("utf-8","gbk",$_POST['jobname']);
			$value['com_id']=(int)$_POST['companyuid'];
			$value['uid']=$this->uid;
			$value['eid']=(int)$_POST['eid'];
			$value['datetime']=mktime();
			$nid=$JobM->AddUseridJob($value);
			$historyM = $this->MODEL('history');
			$historyM->addHistory('useridjob',$jobid);
			if($nid){
				$JobM->UpdateComjob(array("`snum`=`snum`+1"),array("id"=>$jobid));
				$M->UpdateUserStatis(array("`sq_job`=`sq_job`+1"),array("uid"=>$value['com_id']),array("usertype"=>"2"));
				$M->UpdateUserStatis(array("`sq_jobnum`=`sq_jobnum`+1"),array("uid"=>$this->uid),array("usertype"=>"1"));
				if($job['link_type']=='1'){
					$ComM=$this->MODEL("company");
					$job_link=$ComM->GetCompanyInfo(array("uid"=>$job['uid']),array("field"=>"`linkmail` as email"));
				}else{
					$job_link=$JobM->GetComjoblinkOne(array("jobid"=>(int)$_POST['jobid'],"is_email"=>"1"),array("field"=>"`email`"));
				}
				if($this->config["sy_smtpserver"]!="" && $this->config["sy_smtpemail"]!="" &&	$this->config["sy_smtpuser"]!=""){

					if($job_link['email']){
						$contents=@file_get_contents(Url("resume",array("c"=>"sendresume","job_link"=>'1',"id"=>(int)$_POST['eid'])));
						$smtp = $this->email_set();
						$smtpusermail =$this->config['sy_smtpemail'];
						$sendid = $smtp->sendmail($job_link['email'],$smtpusermail,"您收到一份新的求职简历！——".$this->config['sy_webname'],$contents);
					}
				}

				$this->obj->member_log("我申请了职位：".$job['name'],6);
				if($jobid){
					$Weixin=$this->MODEL('weixin');

					$Weixin->sendWxJob($this->uid,$jobid);
				}
			}
			echo $nid?1:2;die;
		}else{
			echo 6;die;
		}
	}
	function favjobuser_action(){
		if(!$this->uid || !$this->username){
			echo 0;die;
		}
		if($_COOKIE['usertype']!=1){
			echo 4;die;
		}
		$JobM=$this->MODEL("job");
		$rows=$JobM->GetFavJobOne(array("uid"=>$this->uid,"job_id"=>(int)$_POST['id']));
		if(!empty($rows)){
			echo 3;die;
		}else{
			$job=$JobM->GetComjobOne(array("id"=>(int)$_POST['id']),array("field"=>"`id`,`com_name`,`name`,`uid`"));
			$data['job_id']=$job['id'];
			$data['com_name']=$job['com_name'];
			$data['job_name']=$job['name'];
			$data['com_id']=$job['uid'];
			$data['uid']=$this->uid;
			$data['datetime']=time();
			$nid=$JobM->AddFavJob($data);
			$historyM = $this->MODEL('history');
			$historyM->addHistory('favjob',$job['id']);
			if($nid){
				$M=$this->MODEL("userinfo");
				$M->UpdateUserStatis(array("`fav_jobnum`=`fav_jobnum`+1"),array("uid"=>$this->uid),array("usertype"=>"1"));
				$this->obj->member_log("收藏了职位：".$job['name'],5);
			}
			echo $nid?1:2;die;
		}
	}
	function index_ajaxjob_action(){
		$jobid=@explode(",",$_POST['jobid']);
		if(is_array($jobid)){
			foreach($jobid as $value){
				if(intval($value)>0){
					$job_ids[] =intval($value);
				}
			}
			$jobid = pylode(",",$job_ids);
		}
		if(!$jobid){
			$jobid=0;
		}
		$JobM=$this->MODEL("job");
		$company_id=$JobM->GetComjobList(array("`id` in (".$jobid.") and `r_status`<>'2' and `status`<>'1'"),array("field"=>"`uid`"));
		if(!empty($company_id)){
			$com_id=array();
			foreach($company_id as $k=>$v){
				if(in_array($v['uid'],$com_id)==false){
					$com_id[]=$v['uid'];
				}
			}
			$com_ids=pylode(',',$com_id);
		}
        $isblackname=$JobM->GetBlackList(array("p_uid"=>(int)$_POST['p_uid'],"usertype"=>"2","`c_uid` in (".$com_ids.")"));
        if(!empty($isblackname) && strstr($jobid,',')==false){
        	echo 4;die;
        }
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=1){
			echo 0;die;
		}else{
			$rows=$JobM->GetUseridJob(array("uid"=>$this->uid,"job_id"=>$jobid));
			if(is_array($rows)&&!empty($rows) && strstr($jobid,',')==false){
				echo 3;die;
			}
			$ResumeM=$this->MODEL("resume");
			$rows=$ResumeM->GetResumeExpectList(array("uid"=>$this->uid),array("field"=>"`id`,`name`"));
			$def_job=$ResumeM->SelectResume(array("uid"=>$this->uid),"def_job");
			if(is_array($rows)&&!empty($rows)){
				foreach($rows as $v){
					if($def_job['def_job']==$v['id']){
						$data.='<em><input type="radio" name="resume" value="'.$v['id'].'" id="resume_'.$v['id'].'" checked/><label for="resume_'.$v['id'].'">'.$v['name'].'</label></em>';
					}else{
						$data.='<em><input type="radio" name="resume" value="'.$v['id'].'" id="resume_'.$v['id'].'"/><label for="resume_'.$v['id'].'">'.$v['name'].'</label></em>';
					}
				}
				echo $data;
			}else{
				echo 2;die;
			}
		}
	}
	function index_ajaxresume_action()
	{
		$JobM=$this->MODEL("job");
		$CompanyM=$this->MODEL("company");
		$M=$this->MODEL("userinfo");
		if($_POST['show_job']&&$_COOKIE['usertype']=='2')
		{
			$company_job=$JobM->GetComjobList(array("uid"=>$this->uid,"state"=>1,"`edate`>'".time()."'"),array("field"=>"`name`,`id`"));
			if($company_job&&is_array($company_job))
			{
				foreach($company_job as $val)
				{
					$html.="<option value='".yun_iconv("gbk","utf-8",$val['name'])."+".$val['id']."'>".yun_iconv("gbk","utf-8",$val['name'])."</option>";
				}
				$arr['html']=$html;
			}else{
				$arr['status']=5;
			}
		}else if($_COOKIE['usertype']!='2'){
			$arr['status']='0';
		}
		if($arr['status']==''){
			$company_yq=$JobM->GetUseridMsgOne(array("fid"=>$this->uid),array("orderby"=>"`id` desc"));
			if(!$company_yq['linkman'] || !$company_yq['linktel'] || !$company_yq['address']){
				$company = $CompanyM->GetCompanyInfo(array("uid"=>$this->uid),array("field"=>"`linkman`,`linktel`,`linkphone`,`address`"));
				if(!$company_yq['linkman']){
					$company_yq['linkman'] = $company['linkman'];
				}
				if(!$company_yq['address']){
					$company_yq['address'] = $company['address'];
				}
				if(!$company_yq['linktel']){
					if($company['linktel']){
						$company_yq['linktel'] = $company['linktel'];
					}else{
						$company_yq['linktel'] = $company['linkphone'];
					}
				}
			}
			$arr['linkman']=yun_iconv("gbk","utf-8",$company_yq['linkman']);
			$arr['linktel']=yun_iconv("gbk","utf-8",$company_yq['linktel']);
			$arr['content']=yun_iconv("gbk","utf-8",$company_yq['content']);
			$arr['address']=yun_iconv("gbk","utf-8",$company_yq['address']);
			$arr['intertime']=yun_iconv("gbk","utf-8",$company_yq['intertime']);
			$row=$M->GetUserstatisOne(array("uid"=>$this->uid),array("field"=>"`rating`,`vip_etime`,`invite_resume`,`rating_type`","usertype"=>2));
			if($row['rating']==0)
			{
				$arr['status']=1;
				$arr['integral']=$this->config['integral_interview'];
			}else{
				if($row['vip_etime']>time() || $row['vip_etime']=="0")
				{
					if($row['rating_type']=="1")
					{
						if($row['invite_resume']==0)
						{
							if($this->config['com_integral_online']=="1")
							{
								$arr['status']=2;
								$arr['integral']=$this->config['integral_interview'];
							}else{
								$arr['status']=4;
							}
						}else{
							$arr['status']=3;
						}
					}else{
						$arr['status']=3;
					}
				}else{
					if($this->config['com_integral_online']=="1")
					{
						$arr['status']=2;
						$arr['integral']=$this->config['integral_interview'];
					}else{
						$arr['status']=4;
					}
				}
			}

		}
		echo json_encode($arr);die;
	}
	function sava_ajaxresume_action(){

		$_POST['uid'] = intval($_POST['uid']);
		$data['uid']=$_POST['uid'];
		$data['title']='面试邀请';
		$data['content']=yun_iconv("utf-8","gbk",$_POST['content']);
		$data['fid']=$this->uid;
		$data['datetime']=time();
		$data['address']=yun_iconv("utf-8","gbk",$_POST['address']);
		$data['intertime']=yun_iconv("utf-8","gbk",$_POST['intertime']);
		$data['linkman']=yun_iconv("utf-8","gbk",$_POST['linkman']);
		$data['linktel']=yun_iconv("utf-8","gbk",$_POST['linktel']);
		$data['jobname']=yun_iconv("utf-8","gbk",$_POST['jobname']);
		$data['jobid']	=yun_iconv("utf-8","gbk",$_POST['jobid']);
		$info['jobname']=yun_iconv("utf-8","gbk",$_POST['jobname']);
		$info['username']=yun_iconv("utf-8","gbk",$_POST['username']);

		$info['content']=$data['content'];
        $p_uid=$_POST['uid'];
        $JobM=$this->MODEL("job");
		$num=$JobM->GetComjobNum(array("uid"=>$this->uid,"state"=>1,"id"=>$data['jobid'],"`edate`>'".time()."'"));
		if($num<1){
			$arr['status']=8;
			$arr['msg']=yun_iconv("gbk","utf-8",'您暂无合适职位！');
			echo json_encode($arr);die;
		}
		$black=$JobM->GetBlackOne(array("p_uid"=>$p_uid,"c_uid"=>$this->uid));
		if(!empty($black))
		{
			$arr['status']=8;
			$arr['msg']=yun_iconv("gbk","utf-8",'您不符合该用户求职需求，无法邀请！');
			echo json_encode($arr);die;
		}
		$black=$JobM->GetBlackOne(array("c_uid"=>$p_uid,"p_uid"=>$this->uid));
		if(!empty($black))
		{
			$arr['status']=9;
			echo json_encode($arr);die;
		}
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=2)
		{
			$arr['status']=0;
			echo json_encode($arr);die;
		}else{
			$umessage = $JobM->GetUseridMsgOne(array("uid"=>$p_uid,"fid"=>$this->uid));
			if(is_array($umessage))
			{
			 	$arr['status']=8;
				$arr['msg']=yun_iconv("gbk","utf-8",'您已经邀请过该人才，请不要重复邀请！');
				echo json_encode($arr);die;
			}else{
				$com=$this->obj->DB_select_once("company","`uid`='".$this->uid."'","name");
				$resume=$this->obj->DB_select_once("resume","`uid`='".$p_uid."'","name,def_job");
				$data['fname']=$com['name'];
				if($_POST['update_yq']=='1')
				{
					$data['default']=1;
				}else{
					$this->obj->DB_update_all("userid_msg","`default`='0'","`fid`='".$this->uid."'");
				}
				$row=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'","`rating`,`vip_etime`,`integral`,`invite_resume`,`rating_type`");
				if($row['rating']==0)
				{
					if($row['integral']<$this->config['integral_interview'] && $this->config['integral_interview_type']=="2")
					{
						$arr['status']=5;
						$arr['integral']=$row["integral"];
					}else{
						$this->obj->insert_into("userid_msg",$data);
						$historyM = $this->MODEL('history');
						$historyM->addHistory('useridmsg',$data['uid']);
						if($this->config['integral_interview_type']=="1")
						{
							$auto=true;
						}else{
							$auto=false;
						}
						$this->company_invtal($this->uid,$this->config['integral_interview'],$auto,"邀请会员面试",true,2,'integral',14);
						$state_content = "我刚邀请了人才 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$resume[def_job]))."\" target=\"_blank\">".$resume['name']."</a> 面试。";
						$this->addstate($state_content,2);
						$arr['status']=3;
						$this->obj->member_log("邀请了人才：".$resume['name'],4);
						$this->msg_post($_POST['uid'],$this->uid,$info);
					}
				}else{
					if($row['vip_etime']>time() || $row['vip_etime']=="0")
					{
						if($row['rating_type']=="1")
						{
							if($row['invite_resume']==0){
								if($row['integral']<$this->config['integral_interview'] && $this->config['integral_interview_type']=="2")
								{
									$arr['status']=5;
									$arr['integral']=$row['integral'];
								}else{
									$this->obj->insert_into("userid_msg",$data);
									$historyM = $this->MODEL('history');
									$historyM->addHistory('useridmsg',$data['uid']);
									if($this->config['integral_interview_type']=="1")
									{
										$auto=true;
									}else{
										$auto=false;
									}
									$this->company_invtal($this->uid,$this->config['integral_interview'],$auto,"邀请会员面试",true,2,'integral',14);
									$state_content = "我刚邀请了人才 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$resume[def_job]))."\" target=\"_blank\">".$resume['name']."</a> 面试。";
									$this->addstate($state_content,2);
									$arr['status']=3;
									$this->obj->member_log("邀请了人才：".$resume['name'],4);
									$this->msg_post($_POST['uid'],$this->uid,$info);
								}
							}else{
								$this->obj->insert_into("userid_msg",$data);
								$historyM = $this->MODEL('history');
								$historyM->addHistory('useridmsg',$data['uid']);
								$this->obj->DB_update_all("company_statis","`invite_resume`=`invite_resume`-1","uid='".$this->uid."'");
								$state_content = "我刚邀请了人才 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$resume[def_job]))."\" target=\"_blank\">".$resume['name']."</a> 面试。";
								$this->addstate($state_content,2);
								$arr['status']=3;
								$this->obj->member_log("邀请了人才：".$resume['name'],4);
								$this->msg_post($_POST['uid'],$this->uid,$info);
							}
						}else{
							$this->obj->insert_into("userid_msg",$data);
							$historyM = $this->MODEL('history');
							$historyM->addHistory('useridmsg',$data['uid']);
							$state_content = "我刚邀请了人才 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$resume[def_job]))."\" target=\"_blank\">".$resume['name']."</a> 面试。";
							$this->addstate($state_content,2);
							$arr['status']=3;
							$this->obj->member_log("邀请了人才：".$resume['name'],4);
							$this->msg_post($_POST['uid'],$this->uid,$info);
						}

					}else{
						if($row['integral']<$this->config['integral_interview'] && $this->config['integral_interview_type']=="2")
						{
							$arr['status']=5;
							$arr['integral']=$row['integral'];
						}else{
							$this->obj->insert_into("userid_msg",$data);
							$historyM = $this->MODEL('history');
							$historyM->addHistory('useridmsg',$data['uid']);
							if($this->config['integral_interview_type']=="1")
							{
								$auto=true;
							}else{
								$auto=false;
							}
							$this->company_invtal($this->uid,$this->config['integral_interview'],$auto,"邀请会员面试",true,2,'integral',14);
							$state_content = "我刚邀请了人才 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$_POST[eid]))."\" target=\"_blank\">".$resume['name']."</a> 面试。";
							$this->addstate($state_content,2);
							$arr['status']=3;
							$this->obj->member_log("邀请了人才：".$resume['name'],4);
							$this->msg_post($_POST['uid'],$this->uid,$info);
						}
					}
				}
				if($arr['status']=='3')
				{

					$Weixin=$this->MODEL('weixin');
					$Weixin->sendWxresume($data);

				}
			}
		}
		echo json_encode($arr);die;
	}
	function msg_post($uid,$comid,$row=''){
		$com=$this->obj->DB_select_once("company","`uid`='".$comid."'","`uid`,`name`,`linkman`,`linktel`,`linkmail`");
		$info=$this->obj->DB_select_once("resume","`uid`='".$uid."'","`email`,`telphone` as `moblie`,`name`");
		$data=array();
		if($this->config["sy_msguser"]&&$this->config["sy_msgpw"]&&$this->config["sy_msgkey"]){
			$data['moblie']=$info['moblie'];
		}
		if($this->config["sy_smtpserver"]&&$this->config["sy_smtpemail"] &&$this->config["sy_smtpuser"]){
			$data['email']=$info['email'];
		}
		$data['uid']=$uid;
		$data['name']=$info['name'];
		$data['cuid']=$com['uid'];
		$data['cname']=$com['name'];
		$data['type']="yqms";
		$data['company']=$com['name'];
		$data['linkman']=$com['linkman'];
		$data['comtel']=$com['linktel'];
		$data['comemail']=$com['linkmail'];
		$data['content']=@str_replace("\n","<br/>",$row['content']);
		$data['jobname']=$row['jobname'];
		$data['username']=$row['username'];
		if($data['email']||$data['moblie']){
			$this->send_msg_email($data);
		}
	}
	function paypost_action(){
		if(is_numeric($_GET['dingdan'])){
			$dingdan=$_GET['dingdan'];
		    $row=$this->obj->DB_select_once("company_order","`order_id`='".$dingdan."'","uid,order_price");
			$uid=$this->obj->DB_select_once("member","`uid`='".$row['uid']."'","email,moblie,uid,`usertype`");
			$fdata=$this->forsend($uid);
			$data['name']=$row['name'];
			$data['uid']=$row['uid'];
			$data['type']="fkcg";
			$data['email']=$uid['email'];
			$data['moblie']=$uid['moblie'];
			$data['order_id']=$dingdan;
			$data['price']=$row['order_price'];
			$data['date']=date("Y-m-d");
			$this->send_msg_email($data);
		}
	}
	function getrating_action(){
		$MemberM=$this->MODEL('userinfo');
		if($_COOKIE['usertype']=="2"){
			$rating=$MemberM->GetRatinginfoAll(array("category"=>3,"display"=>1));
		}else{
			$rating=$MemberM->GetRatinginfoAll(array("category"=>3,"display"=>1));
		}
		if(is_array($rating)){
			foreach($rating as $v){
				$list=array();
				if($v['job_num']>0){
					$list[]='<span class="Download_resume_tips_p_span">发布职位:<em class="Download_resume_tips_c">'.$v[job_num].'</em>份</span>';
				}
				if($v['resume']>0){
					$list[]='<span class="Download_resume_tips_p_span">下载简历:<em class="Download_resume_tips_c">'.$v[resume].'</em>份</span>';
				}
				if($v['interview']>0){
					$list[]='<span class="Download_resume_tips_p_span">邀请面试:<em class="Download_resume_tips_c">'.$v[interview].'</em>份</span>';
				}
				if($v['editjob_num']>0){
					$list[]='<span class="Download_resume_tips_p_span">修改职位:<em class="Download_resume_tips_c">'.$v[editjob_num].'</em>份</span>';
				}
				if($v['breakjob_num']>0){
					$list[]='<span class="Download_resume_tips_p_span">刷新职位:<em class="Download_resume_tips_c">'.$v[breakjob_num].'</em>份</span>';
				}
				$list=@implode("+",$list);
				$html.='<div class="Download_resume_con_list"><div class="Download_resume_tips_h1"><input type="radio" name="comvip" value="'.$v[id].'" class="Download_resume_tips_rad" onClick="check_comvip(\''.$v[service_price].'\')">'.$v[name].'<span class="Download_resume_tips_h1_s">'.$v[service_price].'元</span></div><div  class="Download_resume_tips_p">'.$list.'</div></div>';
			}
		}
		echo $html;die;
	}
	function for_link_action(){
		$eid=(int)$_POST['eid'];
		if(!$this->uid || !$this->username || $_COOKIE['usertype']==1){
			if(!$this->uid || !$this->username){
				$arr['status']=1;
				$arr['msg']="请先登录！";
			}else if($_COOKIE['usertype']=='1'){
				$arr['status']=1;
				$arr['msg']="您不是企业账户，无法下载简历！";
			}
		}else{
			$resume=$this->obj->DB_select_once("down_resume","`eid`='".$eid."' and `comid`='".$this->uid."'");
			$user=$this->obj->DB_select_alls("resume","resume_expect","a.`r_status`<>'2' and a.`uid`=b.`uid` and b.`id`='".$eid."'","a.name,a.telphone,a.telhome,a.email,a.uid,b.id,b.`height_status`");
			$user=$user[0];
			$black=$this->obj->DB_select_once("blacklist","`p_uid`='".$user['uid']."' and `c_uid`='".$this->uid."'");
			if(!empty($black)){
				$arr['status']=1;
				$arr['msg']="该用户已被您列入黑名单！";
			}
			$black=$this->obj->DB_select_once("blacklist","`c_uid`='".$user['uid']."' and `p_uid`='".$this->uid."'");
			if(!empty($black)){
				$arr['status']=1;
				$arr['msg']="您已被该用户列入黑名单！";
			}
			$userid_job=$this->obj->DB_select_once("userid_job","`com_id`='".$this->uid."' and `eid`='".$eid."'");
			if((!empty($resume)||!empty($userid_job))&&$arr['status']==''){
				$arr['status']=3;
			}else if($arr['status']==''){
				if($_COOKIE['usertype']=='2'){
					$row=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'","vip_etime,down_resume,rating_type");
				}
				$data['eid']=$user['id'];
				$data['uid']=$user['uid'];
				$data['comid']=$this->uid;
				$data['downtime']=time();
				if($row['vip_etime']>time() || $row['vip_etime']=="0"){
					if($row['rating_type']==1){
						if($row['down_resume']==0){
							if($this->config['com_integral_online']=="1"){
								$arr['status']=2;
								$arr['uid']=$user['uid'];
								$arr['msg']="你的等级特权已经用完,将扣除".$this->config['integral_down_resume'].$this->config['integral_pricename']."，是否下载？";
							}else{
								$arr['status']=4;
								$arr['msg']="会员下载简历已用完！";
							}
						}else{
							$this->obj->insert_into("down_resume",$data);
							$this->obj->DB_update_all("resume_expect","`dnum`=`dnum`+'1'","`id`='".$eid."'");
							if($_COOKIE['usertype']=='2'){
								$this->obj->DB_update_all("company_statis","`down_resume`=`down_resume`-1","uid='".$this->uid."'");
							}

							$state_content = "新下载了简历 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$user[id]))."\" target=\"_blank\">".$user['name']."</a> 。";
							$this->addstate($state_content,2);
							$arr['status']=3;
							$this->obj->member_log("下载了简历：".$user['name'],3);
							$this->warning("2");
						}
					}else{
						$this->obj->insert_into("down_resume",$data);
						$this->obj->DB_update_all("resume_expect","`dnum`=`dnum`+'1'","`id`='".$eid."'");
						$state_content = "新下载了简历 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$user[id]))."\" target=\"_blank\">".$user['name']."</a> 。";
						$this->addstate($state_content,2);
						$arr['status']=3;
						$this->obj->member_log("下载了简历：".$user['name'],3);
						$this->warning("2");
					}
				}else{
					if($this->config['com_integral_online']=="1"){
						$arr['status']=2;
						$arr['uid']=$user['uid'];
						$arr['msg']="你的等级特权已经用完,将扣除".$this->config['integral_down_resume'].$this->config['integral_pricename']."，是否下载？";
					}else{
						$arr['status']=1;
						$arr['msg']="您的等级特权已到期！";
					}
				}
			}
			if($arr['status']==3){
				$html="<table>";
				$html.="<tr><td align='right' width='90'>".iconv("gbk", "utf-8","手机：")."</td><td>".$user['telphone']."</td></tr>";
				if($user['basic_info']=='1'){
					$html.="<tr><td align='right' width='90'>".iconv("gbk", "utf-8","座机：")."</td><td>".$user['telhome']."</td></tr>";
				}
				$html.="<tr><td align='right' width='90'>".iconv("gbk", "utf-8","邮箱：")."</td><td>".$user['email']."</td></tr>";
				$html.="</table>";
				$arr['html']=$html;
			}
		}
		$arr['msg']=iconv("gbk", "utf-8",$arr['msg']);
		$arr['usertype']=$_COOKIE['usertype'];
		echo json_encode($arr);die;
	}
	function down_resume_action(){
		$eid=(int)$_POST['eid'];
		$uid=(int)$_POST['uid'];
		$type=$_POST['type'];
		$data['eid']=$eid;
		$data['uid']=$uid;
		$data['comid']=$this->uid;
		$data['downtime']=time();
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=2){
			$arr['status']=0;
			$arr['msg']='只有企业会员才可下载简历！';
		}else{
			$black=$this->obj->DB_select_once("blacklist","`p_uid`='".$uid."' and `c_uid`='".$this->uid."'");
			if(!empty($black)){
				$arr['status']=7;
				$arr['msg']="该用户已被您列入黑名单！";
				echo json_encode($arr);die;
			}
			$black=$this->obj->DB_select_once("blacklist","`c_uid`='".$uid."' and `p_uid`='".$this->uid."'");
			if(!empty($black)){
				$arr['status']=8;
				$arr['msg']="您已被该用户列入黑名单！";
				echo json_encode($arr);die;
			}
			$resume=$this->obj->DB_select_once("down_resume","`eid`='$eid' and `comid`='".$this->uid."'");
			if(is_array($resume)){
				$arr['status']=6;
				echo json_encode($arr);die;
			}
			$userid_job=$this->obj->DB_select_once("userid_job","`com_id`='".$this->uid."' and `eid`='".$eid."'");
			if(!empty($userid_job)){
				$this->obj->insert_into("down_resume",$data);
				$this->obj->DB_update_all("resume_expect","`dnum`=`dnum`+'1'","`id`='".$eid."'");
				$state_content = "新下载了 <a href=\"".Url("resume",array('c'=>'show','id'=>$eid))."\" target=\"_blank\">".yun_iconv("utf-8","gbk",$_POST['username'])."</a> 的简历。";
				$this->addstate($state_content,2);
				$this->obj->member_log("下载了 ".yun_iconv("utf-8","gbk",$_POST['username'])." 的简历。",3);
				$this->warning("2");
				$arr['status']=6;
				echo json_encode($arr);die;
			}
			$row=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'","`down_resume`,`integral`,`vip_etime`,`rating`,`rating_type`");
			if($type=="integral")
			{
				if($row['integral']<$this->config['integral_down_resume'] && $this->config['integral_down_resume_type']=="2"){
					$arr['status']=5;
					$arr['integral']=$row['integral'];
				}else{
					$this->obj->insert_into("down_resume",$data);
					if($this->config['integral_down_resume_type']=="1"){
						$auto=true;
					}else{
						$auto=false;
					}
					$this->obj->DB_update_all("resume_expect","`dnum`=`dnum`+'1'","`id`='".$eid."'");
					$this->company_invtal($this->uid,$this->config['integral_down_resume'],$auto,"下载简历",true,2,'integral',13);
					$state_content = "新下载了 <a href=\"".Url("resume",array("c"=>'show','id'=>$eid))."\" target=\"_blank\">".yun_iconv("utf-8","gbk",$_POST['username'])."</a> 的简历。";
					$this->addstate($state_content,2);
					$arr['status']=3;
					$this->obj->member_log("下载了 ".yun_iconv("utf-8","gbk",$_POST['username'])." 的简历。",3);
					$this->warning("2");
				}
			}else{
				$arr['integral']=$this->config['integral_down_resume'];
				if($row['rating']==0){
					$arr['status']=1;
				}else{
					if($row['vip_etime']>time() || $row['vip_etime']=="0"){
						if($row['rating_type']=="1"){
							if($row['down_resume']==0){
								if($this->config['com_integral_online']=="1"){
									$arr['status']=2;
								}else{
									$arr['status']=4;
								}
							}else{
								$this->obj->insert_into("down_resume",$data);
								$this->obj->DB_update_all("resume_expect","`dnum`=`dnum`+'1'","`id`='".$eid."'");
								$this->obj->DB_update_all("company_statis","`down_resume`=`down_resume`-1","uid='".$this->uid."'");
								$state_content = "新下载了 <a href=\"".Url("resume",array("c"=>'show','id'=>(int)$_POST[eid]))."\" target=\"_blank\">".yun_iconv("utf-8","gbk",$_POST['username'])."</a> 的简历。";
								$this->addstate($state_content,2);
								$arr['status']=3;
								$this->obj->member_log("下载了 ".yun_iconv("utf-8","gbk",$_POST['username'])." 的简历。",3);
								$this->warning("2");
							}
						}else{
							$this->obj->insert_into("down_resume",$data);
							$this->obj->DB_update_all("resume_expect","`dnum`=`dnum`+'1'","`id`='".$eid."'");
							$state_content = "新下载了 <a href=\"".Url("resume",array('c'=>'show','id'=>(int)$_POST[eid]))."\" target=\"_blank\">".yun_iconv("utf-8","gbk",$_POST['username'])."</a> 的简历。";
							$this->addstate($state_content,2);
							$arr['status']=3;
							$this->obj->member_log("下载了 ".yun_iconv("utf-8","gbk",$_POST['username'])." 的简历。",3);
							$this->warning("2");
						}
					}else{
						if($this->config['com_integral_online']=="1"){
							$arr['status']=2;
						}else{
							$arr['status']=4;
						}
					}
				}
			}
		}
		if($arr['msg']){
			$arr['msg']=iconv("gbk", "utf-8",$arr['msg']);
		}
		echo json_encode($arr);die;
	}
	function ajax_action(){
		include(PLUS_PATH."city.cache.php");
		if(is_array($_POST['str'])){
			$cityid=$_POST['str'][0];
		}else{
			$cityid=$_POST['str'];
		}
		$data="<option value=''>--请选择--</option>";
		if(is_array($city_type[$cityid])){
			foreach($city_type[$cityid] as $v){
				$data.="<option value='$v'>".$city_name[$v]."</option>";
			}
		}
		echo $data;
	}
    function ajax_job_action(){
		include(PLUS_PATH."job.cache.php");
		if(is_array($_POST[str])){
			$jobid=$_POST[str][0];
		}else{
			$jobid=$_POST[str];
		}
		$data="<option value=''>--请选择--</option>";
		if(is_array($job_type[$jobid])){
			foreach($job_type[$jobid] as $v){
				$data.="<option value='$v'>".$job_name[$v]."</option>";
			}
		}
		echo $data;
	}

    function ajax_ltjob_action(){
		include(PLUS_PATH."ltjob.cache.php");
		$jobid=$_POST['str'];
		$data="<option value=''>--请选择--</option>";
		if(is_array($ltjob_type[$jobid])){
			foreach($ltjob_type[$jobid] as $v){
				$data.="<option value='$v'>".$ltjob_name[$v]."</option>";
			}
		}
		echo $data;
	}
    function exchange_action(){
		$where="`edate`>'".time()."' and `state`='1' and `r_status`<>'2' and `status`<>'1' AND `rec_time`>'".time()."' ORDER BY `lastupdate`  DESC";
		$urlarr['page']="{{page}}";
		$pageurl=Url('index',$urlarr);
		$rows=$this->get_page("company_job",$where,$pageurl,6,"`id`,`name`,`uid`,`com_name`,`salary`,`rec_time`");
		if($rows&&is_array($rows)){
			include(PLUS_PATH."com.cache.php");
			if(count($rows)<6){
				$page=1;
			}else{
				$page=intval($_GET['page'])+1;
			}
			$html="<input type=\"hidden\" value='".$page."' id='exchangep'/>";
			foreach($rows as $key=>$val){
				$job_url=Url("job",array("c"=>"comapply","id"=>$val[id]),"1");
				$com_url=Url('company',array("c"=>"show","id"=>$val[uid]));
				if($val['rec_time']>time()){$val['name']="<font color='red'>".$val['name']."</font>";}
				$html.="<li> <a href=\"".$job_url."\" class=\"job_right_box_list_job\">".$val['name']."</a><a href=\"".$com_url."\" class=\"job_right_box_list_com\">".$val['com_name']."</a><span>薪资：<em class=\"job_right_box_list_c\">".$comclass_name[$val['salary']]."</em></span></li>";
			}
		}
		echo $html;die;
	}
    function mapconfig_action(){
    	$arr=array();
		$arr['map_x']=$this->config['map_x'];
    	$arr['map_y']=$this->config['map_y'];
    	$arr['map_rating']=$this->config['map_rating'];
    	$arr['map_control']=$this->config['map_control'];
    	$arr['map_control_anchor']=$this->config['map_control_anchor'];
    	$arr['map_control_type']=$this->config['map_control_type'];
    	$arr['map_control_xb']=$this->config['map_control_xb'];
    	$arr['map_control_scale']=$this->config['map_control_scale'];
    	echo json_encode($arr);
    }
function getzph_action(){
		if(!$this->uid || !$this->username ){
			$arr['status']=0;
			$arr['content']=iconv("gbk","utf-8","您还没有登录，<a href='javascript:void(0);' onclick=\"showlogin('2');\" style='color:#1d50a1'>请先登录</a>！");
		}else if($_COOKIE['usertype']!=2){
			$arr['status']=8;
			$arr['content']=iconv("gbk","utf-8","您不是企业用户，请先登录企业账户！");
		}else{
			$num=$this->obj->DB_select_num("zhaopinhui_com","uid='".$this->uid."' and zid='".(int)$_GET['id']."'");
			if($num){
				$arr['status']=8;
				$arr['content']=iconv("gbk","utf-8","您已报名该招聘会！");
			}else{
				$row=$this->obj->DB_select_all("company_job","`uid`='".$this->uid."' and `state`='1' and `r_status`<>'2' and `status`<>'1' and  `edate`>'".time()."'","`id`,`name`");
				if(is_array($row)&&$row){
					foreach($row as $v){
						$data.='<input type="checkbox" name="checkbox_job" value="'.$v['id'].'" id="status_'.$v['id'].'"><label for="status_'.$v['id'].'">'.$v['name'].'</label><br>';
					}
					$arr['status']=1;
					$arr['uid']=$this->uid;
					$arr['content']=iconv("gbk","utf-8",$data);
				}else{
					$arr['status']=2;
					$jobaddurl=URL("member",array("c"=>jobadd));
					$arr['content']=iconv("gbk","utf-8","您还没有有效职位，<a href='".$jobaddurl."' style='color:#1d50a1'>请先添加职位</a>");
				}
			}
		}
		echo json_encode($arr);
	}
	function zphcom_action(){
		if(!$this->uid || !$this->username || $_COOKIE['usertype']!=2){
			$arr['status']=0;
			$arr['content']=iconv("gbk","utf-8","您还没有登录，<a href='javascript:void(0);' onclick=\"showlogin('2');\" style='color:#1d50a1'>请先登录</a>！");
		}elseif(!$_GET['pid']){
			$arr['status']=0;
			$arr['content']=iconv("gbk","utf-8","你没有选择招聘会");
		}elseif(!$_GET['jobid']){
			$arr['status']=0;
			$arr['content']=iconv("gbk","utf-8","你还没有选择职位");
		}elseif(is_array($this->obj->DB_select_once("zhaopinhui_com","uid='".$this->uid."' and zid='".(int)$_GET['pid']."'"))){
			$arr['status']=0;
			$arr['content']=iconv("gbk","utf-8","您已经参与该招聘会");
		}else{
			$jobidarr=@explode(",",$_GET['jobid']);
			$array=array();
			foreach($jobidarr as $v){
				if(!in_array($v,$array)){
					$array[]=$v;
				}
			}
			$sql['uid']=$this->uid;
			$sql['zid']=(int)$_GET['pid'];
			$sql['jobid']=pylode(",",$array);
			$sql['ctime']=mktime();
			$sql['status']=0;
			$id=$this->obj->insert_into("zhaopinhui_com",$sql);
			if($id){
				$arr['status']=1;
				$arr['content']=iconv("gbk","utf-8","报名成功,等待管理员审核");
				$this->obj->member_log("报名招聘会");//会员日志
			}else{
				$arr['status']=0;
				$arr['content']=iconv("gbk","utf-8","报名失败,请稍后重试");
			}
		}
		echo json_encode($arr);
	}
    function resume_word_action(){
		$resumename=$this->obj->DB_select_once("resume_expect","`id`='".(int)$_GET['id']."'","`name`");
		$resume=$this->obj->DB_select_once("down_resume","`eid`='".(int)$_GET['id']."' and `comid`='".$this->uid."'");
		if(is_array($resume) && !empty($resume)){

			$content = file_get_contents(Url('resume',array('c'=>'show','id'=>(int)$_GET['id'],'downtime'=>$resume['downtime'],'type'=>'word')));
			$this->startword($resumename['name'],$content);
		}
	}
	function startword($wordname,$html){
        ob_start();
     	header("Content-Type:  application/msword");
		header("Content-Disposition:  attachment;  filename=".$wordname.".doc");
		header("Pragma:  no-cache");
		header("Expires:  0");
		echo $html;
    }
    function makefriends_action(){
    	if($this->uid&&$this->username){
    		$id=(int)$_POST['id'];
    		if($id==$this->uid){
    			echo 4;die;
    		}
			if($_POST['type']=="1"){
				$itcert = $this->obj->DB_select_once("resume","`uid`='".$id."' and `idcard_status`='1'");
			}elseif($_POST['type']=="2"){
				$itcert = $this->obj->DB_select_once("company","`uid`='".$id."' and `yyzz_status`='1'");
			}
    		$info = $this->obj->DB_select_once("member","`uid`='".$this->uid."'");
			$isfriend = $this->obj->DB_select_once("friend","`uid`='".$this->uid."' and `nid`='".$id."'");
			if($isfriend['status']=='1'){
				echo 6;die;
			}elseif($isfriend['status']=='0'){
				echo 7;die;
			}else{
				if($info['usertype']==1){
					$iscert = $this->obj->DB_select_once("resume","`uid`='".$this->uid."' and `idcard_status`='1'");
				}else if($info['usertype']==2){
					$iscert = $this->obj->DB_select_once("company","`uid`='".$this->uid."' and `yyzz_status`='1'");
				}
				if(!empty($iscert) && empty($itcert)){
					echo 2;die;
				}else if(empty($iscert)){
					echo 3;die;
				}
				$this->obj->DB_insert_once("friend","`uid`='".$this->uid."',`uidtype`='".$info['usertype']."',`nid`='".$id."',`nidtype`='".(int)$_POST['type']."',`status`='0'");
				$this->unset_remind("friend".$_POST['type'],$_POST['type']);
				$this->obj->member_log("添加好友");
				echo 1;die;
			}
    	}else{
    		echo 5;die;
    	}
    }
    function show_citysearch_action(){
        $CacheList=$this->MODEL('cache')->GetCache(array('city'));
		$this->yunset($CacheList);extract($CacheList);
		$html=' <div class="student_tips" style="left: 550px;"></div><div class="clear"></div><div class="sPopupBlock sPopupBlock_city"><div class="clear" style="height: 5px;"></div><div class="pCityItemB" style="display: block;"><div class="sPopupTabCB"><table class="sPopupTabC" cellspacing="0" cellpadding="0" border="0"><tbody><tr>';
		if(is_array($city_index)){
			foreach($city_index as $j=>$v){
				$html.=' <td class="blurItem" width="15%" id="td_city'.$v.'" onclick="showcity(\''.$v.'\')" onmouseout="guanbicity(\''.$v.'\');"><span class="availItem" style="display: ;" id="span_city'.$v.'" >'.$city_name[$v].'</span>
                <div class="seach_tck_box_hy" style="display:none;" id="div_city'.$v.'" >';
                $html.='<div class="s_b_city_icon"></div><span>'.$city_name[$v].'</span>';
				if (($j+1)%6==0 || ($j+1)%6==4 || ($j+1)%6==5){
					$html.='<div class="sPopupDivSubJobname sPopupDivSubCity" style="background-position:-2px -1px;z-index:1001;left:-246px; top: 19px; ">';
				}else{
					$html.=' <div class="sPopupDivSubJobname sPopupDivSubCity" style="background-position: 105px -1px; z-index: 1001; left: -5px; top:19px; ">';
				}
				$html.=' <div class="paddingBlock">';
				if(is_array($city_type[$v])){
					foreach($city_type[$v] as $jj=>$vv){
						$html.='<span class="subCboxItem mOutItem" style="width:107px;" onclick="checkcity(\''.$vv.'\',\''.$city_name[$vv].'\');"> <span class="availItem" >'.$city_name[$vv].'</span> </span>';
					}
				}
				$html.=' <div class="clear"></div></div></div></td>';
				if(($j+1)%6==0){
					$html.='</tr><tr>';
				}
			}
		}
		echo $html.=' <tr></tbody></table><div class="clear" style="height: 5px;"></div></div></div></div>';die;
	}
    function show_leftjob_action(){
		$CacheList=$this->MODEL('cache')->GetCache(array('job'));
		$this->yunset($CacheList);extract($CacheList);
		$html.='<ul>';
		if(is_array($job_index)){
			foreach($job_index as $j=>$v){
				if($j<17){
					$html.='<li class="lst'.$j.' " onmouseover="show_job(\''.$j.'\',\'0\');" onmouseout="hide_job(\''.$j.'\');"> <b></b> <a class="link" href="'.Url("com",array('c'=>'search','job1'=>$v),"1").'" title="'.$job_name[$v].'">'.$job_name[$v].'</a> <i></i><div class="lstCon"><div class="lstConClass">';
					if(is_array($job_type[$v])){
						foreach($job_type[$v] as $vv){
							$html.=' <dl><dt> <a  href="'.Url("com",array('c'=>'search','job1'=>$v,'job1_son'=>$vv),"1").'" title="'.$job_name[$vv].'">'.$job_name[$vv].'</a> </dt><dd> ';
							if(is_array($job_type[$vv])){
								foreach($job_type[$vv] as $vvv){
									$html.=' <a  href="'.Url("com",array('c'=>'search','job1'=>$v,'job1_son'=>$vv,'job_post'=>$vvv),"1").'" title="'.$job_name[$vvv].'">'.$job_name[$vvv].' </a>';
								}
							}
							$html.=' </dd><dd style="display:block;clear:both;float:inherit;width:100%;font-size:0;line-height:0;"></dd></dl>';
						}
					}
					$html.=' </div> </div></li>';
				}
			}
		}
		echo $html.=' </ul>';die;
	}
    function wap_job_action(){
		include(PLUS_PATH."job.cache.php");
		if($_POST['type']==1){
			$data="<option value=''>--请选择--</option>";
		}
		if(is_array($job_type[$_POST['id']])){
			foreach($job_type[$_POST['id']] as $v){
				$data.="<option value='$v'>".$job_name[$v]."</option>";
			}
		}
		echo $data;
	}
	function wap_city_action()
	{
		include(PLUS_PATH."city.cache.php");
		if($_POST['type']==1)
		{
			$data="<option value=''>--请选择--</option>";
		}
		if(is_array($city_type[$_POST['id']])){
			foreach($city_type[$_POST['id']] as $v){
				$data.="<option value='$v'>".$city_name[$v]."</option>";
			}
		}
		echo $data;
	}
	function def_email_action(){
		$type=(int)$_POST['type'];
		$_POST['email']=yun_iconv("utf-8","gbk",$_POST['email']);
		$postemail=@explode("@",$_POST['email']);
		$def_email=@explode("|",$this->config['sy_def_email']);
		if($postemail[1]!=""){
			foreach($def_email as $v){
				if(stripos($v,$postemail[1])!==false){
					$email[]=$v;
				}
			}
		}else{
			$email=$def_email;
		}
		foreach($email as $k=>$v){
			if($k==0){
				$class=" reg_email_box_list_hover";
			}else{
				$class="";
			}
			$html.='<div class="reg_email_box_list'.$class.' email'.$k.'" aid="'.$type.'" onclick="click_email('.$k.','.$type.');" onmousemove="hover_email('.$k.');"><span class="eg_email_box_list_left">'.$postemail[0].'</span>'.$v.'</div>';
		}
		echo count($email)."##".$html;
	}
	function saveresumetemplate_action(){
		$_POST['eid']=intval($_POST['eid']);
		$user_expect=$this->obj->DB_select_once("resume_expect","`id`='".$_POST['eid']."'");
		if($user_expect['uid']==$this->uid&&$this->uid!=''){
    		$update=$this->obj->DB_update_all("resume_expect","`tmpid`='".$_POST['tmpid']."'","`id`='".$_POST['eid']."'");
			$arr['url']=Url("resume",array("c"=>"show","id"=>$_POST['eid']));
			$update?$arr['status']='9':$arr['status']='8';
			$update?$arr['msg']='设置成功！':$arr['msg']='设置失败！';
		}else{
			$arr['status']='8';
			$arr['msg']='对不起，您无权操作！';
		}
		$arr['msg']=iconv("gbk","utf-8",$arr['msg']);
		echo json_encode($arr);die;
    }
    function jobrecord_action(){
		if((int)$_POST['page']==''){$_POST['page']=1;}
		$page=(int)$_POST['page'];
		$id=(int)$_POST['id'];
		$allnum=$this->obj->DB_select_num("userid_job","`job_id`='".$id."'");
		$html=$phtml=$pagehtml='';
		if($allnum>10){
			$pagenum=ceil($allnum/10);
			$start=($page-1)*10;
			$limit=" limit ".$start.",10";
			if($page>1){$phtml.="<a class=\"Company_pages_a\"  onclick=\"forrecord('".$id."','1')\">首页</a><a class=\"Company_pages_a\" onclick=\"forrecord('".$id."','".($page-1)."')\">前页</a>";}
			if($page%5>0){
				$spage=floor($page/5)*5+1;
				$epage=ceil($page/5)*5;
			}else{
				$spage=$page-4;
				$epage=$page;
			}
			if($epage>$pagenum){$epage=$pagenum;}
			for($i=$spage;$i<=$epage;$i++){
				$page==$i?$phtml.="<span class=\"Company_pages_cur\">".$i."</span>":$phtml.="<a class=\"Company_pages_a\" onclick=\"forrecord('".$id."','".$i."')\">".$i."</a>";
			}
			if($pagenum-$page>0){$phtml.="<a class=\"Company_pages_a\" onclick=\"forrecord('".$id."','".($page+1)."')\">后页</a><a class=\"Company_pages_a\" onclick=\"forrecord('".$id."','".$pagenum."')\"> 尾页</a>";}
			$pagehtml="<div class=\"Company_pages\">".$phtml."</div>";
		}
		$rows=$this->obj->DB_select_all("userid_job","`job_id`='".$id."' order by `datetime` desc ".$limit);
		if($rows&&is_array($rows)){
			$uid=$username=array();
			$is_browse=array('1'=>'待反馈','2'=>'企业已查看');
			foreach($rows as $val){
				$uid[]=$val['uid'];
			}
			$resume=$this->obj->DB_select_all("resume","`uid` in(".pylode(',',$uid).")","`uid`,`name`");
			foreach($resume as $val){
				$username[$val['uid']]=mb_substr($val["name"],0,2)."**";
			}
			foreach($rows as $val){
				$html.="<div class=\"Company_Record_list\">
					 <span class=\"Company_Record_span Company_Record_spanzhe\">".$username[$val['uid']]."</span>
					 <span class=\"Company_Record_span Company_Record_spantime\">".date("Y-m-d H:s",$val['datetime'])."</span>
					 <span class=\"Company_Record_span Company_Record_spanzt Company_Record_span_cor\">".$is_browse[$val['is_browse']]."</span>
				</div>";
			}
			$html.=$pagehtml;
		}else{
			$html="<div class=\"comapply_no_msg\"><div class=\"comapply_no_msg_cont\"><span></span><em>暂无数据</em></div></div>";
		}
		echo $html;die;
	}

	function getcity_subscribe_action(){
		include(PLUS_PATH."city.cache.php");
		if(is_array($city_type[$_POST['id']])){
			$data='<ul class="post_read_text_box_list">';
			foreach($city_type[$_POST['id']] as $v){
				$data.="<li><a href=\"javascript:check_input('".$v."','".$city_name[$v]."','".$_POST['type']."');\">".$city_name[$v]."</a></li>";
			}
			$data.='</ul>';
		}
		echo $data;die;
	}
	function getjob_subscribe_action(){
		include(PLUS_PATH."job.cache.php");
		if(is_array($job_type[$_POST['id']])){
			$data='<ul class="post_read_text_box_list">';
			foreach($job_type[$_POST['id']] as $v){
				$data.="<li><a href=\"javascript:check_input('".$v."','".$job_name[$v]."','".$_POST['type']."');\">".$job_name[$v]."</a></li>";
			}
			$data.='</ul>';
		}
		echo $data;die;
	}
	function getsalary_subscribe_action(){
		if($_POST['type']==1){
			include(PLUS_PATH."com.cache.php");
			if(is_array($comdata['job_salary'])){
				$data='<ul class="post_read_text_box_list">';
				foreach($comdata['job_salary'] as $v){
					$data.="<li><a href=\"javascript:check_input('".$v."','".$comclass_name[$v]."','salary');\">".$comclass_name[$v]."</a></li>";
				}
				$data.='</ul>';
			}
		}else{
			include(PLUS_PATH."user.cache.php");
			if(is_array($userdata['user_salary'])){
				$data='<ul class="post_read_text_box_list">';
				foreach($userdata['user_salary'] as $v){
					$data.="<li><a href=\"javascript:check_input('".$v."','".$userclass_name[$v]."','salary');\">".$userclass_name[$v]."</a></li>";
				}
				$data.='</ul>';
			}
		}
		echo $data;die;
	}
    function wx_message($uid,$title,$description,$url,$picurl){
		$uid = intval($uid);
		$Token = getToken($this->config);
		$WxUrl = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$Token;
		$Touser = 'oG35CuD8C1aBBWWPzC8x8F1xbxhI';
		$Data ='{
			"touser":"'.$Touser.'",
			"msgtype":"news",
			"news":{
				"articles": [
				 {
					 "title":"'.iconv('gbk','utf-8',$title).'",
					 "description":"'.iconv('gbk','utf-8',$description).'",
					 "url":"'.$url.'",
					 "picurl":"'.$picurl.'"
				 }
				]
			}
		}';
		$return = CurlPost($WxUrl,$Data);
	}
    function regcode_action(){
		if($_POST['moblie']==""){
			echo 0;die;
		}
		$randstr=rand(100000,999999);

		if($this->config['sy_msguser']==""||$this->config['sy_msgpw']==""||$this->config['sy_msgkey']==""){
			echo 4;die;
		}else{
			$moblieCode = $this->obj->DB_select_once('company_cert',"`check`='".$_POST['moblie']."'");
			if((time()-$moblieCode['ctime'])<120){
				echo 5;die;
			}
			$status=$this->send_msg_email(array("moblie"=>$_POST['moblie'],"code"=>$randstr));
			if($status=='1'){
				$data['uid']='0';
				$data['type']='2';
				$data['status']='0';
				$data['step']='1';
				$data['check']=$_POST['moblie'];
				$data['check2']=$randstr;
				$data['ctime']=time();
				$data['statusbody']='手机注册验证码';
				if(is_array($moblieCode) && !empty($moblieCode)){
					$this->obj->update_once("company_cert",$data,"`check`='".$_POST['moblie']."'");
				}else{
					$this->obj->insert_into("company_cert",$data);
				}
			}
			echo $status;die;
		}
	}
    function talent_pool_action(){
		if($_COOKIE['usertype']!="2"){
			echo 0;die;
		}
		$row=$this->obj->DB_select_once("talent_pool","`eid`='".(int)$_POST['eid']."' and `cuid`='".$this->uid."'");
		if(empty($row)){
			$value.="`eid`='".(int)$_POST['eid']."',";
			$value.="`uid`='".(int)$_POST['uid']."',";
			$value.="`remark`='".yun_iconv("utf-8","gbk",$_POST['remark'])."',";
			$value.="`cuid`='".$this->uid."',";
			$value.="`ctime`='".time()."'";
			$this->obj->DB_insert_once("talent_pool",$value);
			$historyM = $this->MODEL('history');
			$historyM->addHistory('talentpool',(int)$_POST['eid']);
			echo 1;die;
		}else{
			echo 2;die;
		}
	}
	function atn_action()
	{
		$id=(int)$_POST['id'];
		if($id>0){
			if($_COOKIE['usertype']!="1"){
				echo 0;die;
			}
			if($this->uid>0){
				if($_POST['id']==$this->uid){
					echo 4;die;
				}
				$atninfo = $this->obj->DB_select_once("atn","`uid`='".$this->uid."' AND `sc_uid`='".$id."'");
				$user=$this->obj->DB_select_once("member","`uid`='".$id."'","`usertype`");
				if($user['usertype']=="2"){
					$table="company";
				}
				$comurl = Url('ask',array("c"=>"friend","uid"=>$id));
				$row=$this->obj->DB_select_once("friend_info","`uid`='".$id."'","nickname");
				$name = $row['nickname'];
				if(is_array($atninfo)&&!empty($atninfo))
				{
					$this->obj->DB_delete_all("atn","`uid`='".$this->uid."' AND `sc_uid`='".$id."'");
					$this->obj->DB_update_all($table,"`ant_num`=`ant_num`-1","`uid`='".$id."'");
					$content="取消了对<a href=\"".$comurl."\">".$name."</a>的关注！";
					$this->addstate($content,2);
					$msg_content = "用户 ".$this->username." 取消了对你的关注！";
					$this->automsg($msg_content,(int)$_POST['id']);
					$this->obj->member_log("取消了对".$name."的关注！");
					echo "2";die;
				}else{
					$this->obj->DB_insert_once("atn","`uid`='".$this->uid."',`sc_uid`='".$id."',`usertype`='".(int)$_COOKIE['usertype']."',`sc_usertype`='".$user['usertype']."',`time`='".time()."'");
					$this->obj->DB_update_all($table,"`ant_num`=`ant_num`+1","`uid`='".$id."'");
					$content="关注了<a href=\"".$comurl."\">".$name."</a>";
					$this->addstate($content,2);
					$msg_content = "用户 ".$this->username." 关注了你！";
					$this->automsg($msg_content,(int)$_POST['id']);
					$this->obj->member_log("关注了".$name);
					echo "1";die;
				}
			}else{
				echo "3";die;
			}
		}
	}
	function atn_company_action(){
		$id=(int)$_POST['id'];
		if($id>0){
			if($this->uid){
				if($_COOKIE['usertype']!='1'){
					echo '4';die;
				}
				$atninfo = $this->obj->DB_select_once("atn","`uid`='".$this->uid."' AND `sc_uid`='".$id."'");
				$comurl = $this->config['sy_weburl']."/company/index.php?id=".$id;
				$company=$this->obj->DB_select_once("company","`uid`='".$id."'","`name`");
				$name = $company['name'];
				if(is_array($atninfo)&&$atninfo){
					$this->obj->DB_delete_all("atn","`uid`='".$this->uid."' AND `sc_uid`='".$id."'");
					$this->obj->DB_update_all('company',"`ant_num`=`ant_num`-1","`uid`='".$id."'");
					$content="取消了对<a href=\"".$comurl."\">".$name."</a>关注";
					$this->addstate($content,2);
					$msg_content = "用户 ".$this->username." 取消了对你的关注！";
					$this->automsg($msg_content,$id);
					$this->obj->member_log("取消了对".$name."关注");
					echo "2";die;
				}else{
					$this->obj->DB_insert_once("atn","`uid`='".$this->uid."',`sc_uid`='".$id."',`usertype`='".(int)$_COOKIE['usertype']."',`sc_usertype`='2',`time`='".time()."'");
					$this->obj->DB_update_all('company',"`ant_num`=`ant_num`+1","`uid`='".$id."'");
					$content="关注了<a href=\"".$comurl."\">".$name."</a>";
					$this->addstate($content,2);
					$msg_content = "用户 ".$this->username." 关注了你！";
					$this->automsg($msg_content,$id);
					$this->obj->member_log("关注了".$name);
					echo "1";die;
				}
			}else{
				echo "3";die;
			}
		}
	}

	function RedLoginHead_action(){
		if($_COOKIE['uid']!=""&&$_COOKIE['username']!=""){
			if($_COOKIE['remind_num']>0){
				$html.='<div class="header_Remind header_Remind_hover"> <em class="header_Remind_em "><i class="header_Remind_msg"></i></em><div class="header_Remind_list" style="display:none;">';
				if($_COOKIE['usertype']==1){
					$html.='<div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=msg">邀请面试</a><span class="header_Remind_list_r fr">('.$_COOKIE['userid_msg'].')</span></div><div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=xin">站内信</a><span class="header_Remind_list_r fr">('.$_COOKIE['friend_message1'].')</span></div><div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=sysnews">系统消息</a><span class="header_Remind_list_r fr">('.$_COOKIE['sysmsg1'].')</span></div><div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=commsg">企业回复咨询</a><span class="header_Remind_list_r fr">('.$_COOKIE['usermsg'].')</span></div>';
				}elseif($_COOKIE['usertype']==2){
					$html.='<div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=hr"class="fl">申请职位</a><span class="header_Remind_list_r fr">('.$_COOKIE['userid_job'].')</span></div><div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=xin"class="fl">站内信</a><span class="header_Remind_list_r fr">('.$_COOKIE['friend_message2'].')</span></div><div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=sysnews" class="fl"> 系统消息</a><span class="header_Remind_list_r fr">('.$_COOKIE['sysmsg2'].')</span></div><div class="header_Remind_list_a"><a href="'.$this->config['sy_weburl'].'/member/index.php?c=msg"class="fl">求职咨询</a><span class="header_Remind_list_r fr">('.$_COOKIE['commsg'].')</span></div>';
				}
				$html.='</div> </div>';
			}
			$html2= "您好：<a href=\"".$this->config['sy_weburl']."/member\" ><font color=\"red\">".$_COOKIE['username']."</font></a>！<a href=\"javascript:void(0)\" onclick=\"logout(\'".$this->config['sy_weburl']."/index.php?c=logout\');\">[安全退出]</a>";

			$html.='<div class=" fr">'.$html2.'</div>';

			echo "document.write('".$html."');";
		}else{
			$login_url = Url("login",array(),"1");
			$reg_url = Url("register",array("usertype"=>"1"),"1");
			$reg_com_url = Url("register",array("usertype"=>"2"),"1");
			$style = $this->config['sy_weburl']."/app/template/".$this->config['style'];

			$login='<li><a href="'.$login_url.'">会员登录</a></li>';
			$user_reg='<li><a href="'.$reg_url.'">个人注册</a></li>';
			$com_reg='<li><a href="'.$reg_com_url.'">企业注册</a></li>';

			$html='<div class=" fr"><div class="yun_topLogin_cont"><div class="yun_topLogin"><a class="yun_More" href="javascript:void(0)">用户登录</a><ul class="yun_Moredown" style="display:none">'.$login.$lt_login.'</ul></div><div class="yun_topLogin"> <a class="yun_More" href="javascript:void(0)">用户注册</a><ul class="yun_Moredown fn-hide" style="display:none">'.$user_reg.$com_reg.$lt_reg.'</ul></div></div></div>';
			if($this->config['sy_qqlogin']=='1'||$this->config['sy_sinalogin']=='1'||$this->config['sy_wxlogin']=='1'){
				$flogin='<div class="fastlogin fr">';
				if($this->config['sy_qqlogin']=='1'){
					$flogin.='<span style="width:70px;"><img src="'.$this->config['sy_weburl'].'/app/template/'.$this->config['style'].'/images/yun_qq.png" class="png" > <a href="'.$this->config['sy_weburl'].'/qqlogin.php'.'">QQ登录</a></span>';
				}
				if($this->config['sy_sinalogin']=='1'){
					$flogin.='<span><img src="'.$this->config['sy_weburl'].'/app/template/'.$this->config['style'].'/images/yun_sina.png" class="png"> <a href="'.Url("sinaconnect",array(),"1").'">新浪</a></span>';
				}
				if($this->config['sy_wxlogin']=='1'){
					$flogin.='<span><img src="'.$this->config['sy_weburl'].'/app/template/'.$this->config['style'].'/images/yun_wx.png" class="png"> <a href="'.Url("wxconnect",array(),"1").'">微信</a></span>';
				}
				$flogin.='</div>';
				$html.=$flogin;
			}
			echo "document.write('".$html."');";
		}
	}
	function DefaultLoginIndex_action(){
		if($_COOKIE['usertype']=='1' && $this->uid){
			$member=$this->obj->DB_select_alls("member_statis","resume","a.`uid`='".$this->uid."' and b.`uid`='".$this->uid."'","a.*,b.`photo`");
			if($member[0]['photo']==''){
				$member[0]['photo']=$this->config['sy_weburl']."/".$this->config['sy_member_icon'];
			}
			$this->yunset("member",$member[0]);
		}else if($_COOKIE['usertype']=='2' && $this->uid){
			$company=$this->obj->DB_select_alls("company_statis","company","a.`uid`='".$this->uid."' and b.`uid`=a.`uid`","a.`sq_job`,a.`fav_job`,b.`logo`");
			if($company[0]['logo']==''){
				$company[0]['logo']=$this->config['sy_weburl']."/".$this->config['sy_unit_icon'];
			}
			$company=$company[0];
			$company['job']=$this->obj->DB_select_num("company_job","`uid`='".$this->uid."'");
			$company['status2']=$this->obj->DB_select_num("company_job","`edate`<time() and `uid`='".$this->uid."'");
			$this->yunset("company",$company);
		}
		$this->yunset("cookie",$_COOKIE);
		$this->yun_tpl(array('login'));
	}

	function Site_action(){
		if($this->config['sy_web_site']=="1"){
			if($_SESSION['cityname']){
				$cityname = $_SESSION['cityname'];
			}else{
				$cityname = $this->config['sy_indexcity'];
			}
			$site_url = Url('index',array("c"=>"site"),"1");
		    $html = "<div class=\"heder_city_line\"><em  class=\"heder_city_jr \">进入</em><span class=\"header_city_h1\">".$cityname."站</span><span class=\"header_city_more icon2\"><a href=\"".$site_url."\">[切换城市]</a></span></div>";
		} echo "document.write('".$html."');";
	}
	function SiteCity_action(){
		if($_POST[cityid]=="nat"){
			unset($_SESSION['cityid']);unset($_SESSION['three_cityid']);unset($_SESSION['cityname']);unset($_SESSION['hyclass']);
			if($this->config['sy_indexdomain']){
				$_SESSION['host'] = $this->config['sy_indexdomain'];
			}else{
				$_SESSION['host'] = $this->config['sy_weburl'];
			}

			echo $_SESSION['host'];
			die;
		}
		unset($_SESSION['cityid']);unset($_SESSION['three_cityid']);unset($_SESSION['cityname']);unset($_SESSION['newsite']);unset($_SESSION['host']);unset($_SESSION['did']);unset($_SESSION['hyclass']);
		if((int)$_POST['cityid']>0){
			if(file_exists(PLUS_PATH."/domain_cache.php")){
				include(PLUS_PATH."/domain_cache.php");
				if(is_array($site_domain)){
					foreach($site_domain as $key=>$value){
						if($value['cityid']==$_POST['cityid'] || $value['three_cityid']==$_POST['cityid']){
							$_SESSION['host'] = $value['host'];
						}
						if($value['three_cityid']==$_POST['cityid']){
							$_SESSION['three_cityid'] = $value['three_cityid'];
						}
					}
				}
			}
			if($_SESSION['host'] && "http://".$_SESSION['host']==$this->config['sy_weburl'] ){
				$_SESSION[newsite]="new";
			}
			$_SESSION['host'] = $_SESSION['host']!=""?"http://".$_SESSION['host']:$this->config['sy_weburl'];
			if(!$_SESSION['three_cityid']){
				$_SESSION['cityid'] = $_POST['cityid'];
			}
			$_SESSION['cityname'] = yun_iconv("utf-8","gbk",$_POST['cityname']);
			echo $_SESSION['host'];
			die;
		}else{
			$this->ACT_layer_msg("传递了非法参数！",8,$_SERVER['HTTP_REFERER']);
		}
	}
	function SiteHy_action(){
		if($_POST['hyid']=="0"){
			unset($_SESSION['cityid']);unset($_SESSION['three_cityid']);unset($_SESSION['cityname']);unset($_SESSION['hyclass']);
			$_SESSION['host'] = $this->config['sy_indexdomain'];
			echo $_SESSION['host'];die;
		}
		unset($_SESSION['cityid']);
		unset($_SESSION['three_cityid']);
		unset($_SESSION['cityname']);
		unset($_SESSION['newsite']);
		unset($_SESSION['host']);
		unset($_SESSION['did']);
		unset($_SESSION['hyclass']);
		if((int)$_POST['hyid']>0){
			if(file_exists(PLUS_PATH."/domain_cache.php")){
				include(PLUS_PATH."/domain_cache.php");
				if(is_array($site_domain)){
					foreach($site_domain as $key=>$value){
						if($value['hy']==$_POST['hyid']){
							$_SESSION['host'] = $value['host'];
						}
					}
				}
			}
			if($_SESSION['host'] && "http://".$_SESSION['host']==$this->config['sy_weburl'] ){
				$_SESSION['newsite']="new";
			}
			$_SESSION['host'] = $_SESSION['host']!=""?"http://".$_SESSION['host']:$this->config['sy_weburl'];
			$_SESSION['hyclass'] = $_POST['hyid'];
			echo $_SESSION['host'];die;
		}else{
			$this->ACT_layer_msg("传递了非法参数！",8,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>