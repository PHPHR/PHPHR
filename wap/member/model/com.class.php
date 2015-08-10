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
class com_controller extends wap_controller{
	function waptpl($tpname){
		$this->yuntpl(array('wap/member/com/'.$tpname));
	}
	function index_action(){
		$this->rightinfo();
		$company=$this->obj->DB_select_once("company","`uid`='".$this->uid."'","`name`,`logo`");
		$this->yunset("company",$company);
		$sqnum=$this->obj->DB_select_num("userid_job","`com_id`='".$this->uid."'");
		$this->yunset("sqnum",$sqnum);
		$jobnum=$this->obj->DB_select_num("company_job","`uid`='".$this->uid."'");
		$this->yunset("jobnum",$jobnum);
		$talent_pool_num=$this->obj->DB_select_num("talent_pool","`cuid`='".$this->uid."'");
		$this->yunset("talent_pool_num",$talent_pool_num);
		$this->waptpl('index');
	}
	function com_action(){
		$this->rightinfo();
		$statis=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'","rating_name,integral");
		$statis[integral]=number_format($statis[integral]);
		$this->yunset("statis",$statis);
		$this->waptpl('com');
	}
	function info_action(){
		$this->rightinfo();
		if($_POST['submit']){
			$_POST=$this->post_trim($_POST);
			if($_POST['name']==""){
				$data['msg']='企业全称不能为空！';
			}elseif($_POST['hy']==""){
				$data['msg']='从事行业不能为空！';
			}elseif($_POST['pr']==""){
				$data['msg']='企业性质不能为空！';
			}elseif($_POST['provinceid']==""){
				$data['msg']='所在地不能为空！';
			}elseif($_POST['mun']==""){
				$data['msg']='企业规模不能为空！';
			}else if($_POST['address']==""){
				$data['msg']='公司地址不能为空！';
			}else if($_POST['linkphone']==""){
				$data['msg']='固定电话不能为空！';
			}else if($_POST['linkmail']==""){
				$data['msg']='联系邮件不能为空！';
			}elseif($_POST['content']==""){
				$data['msg']='企业简介不能为空！';
			}
			if($data['msg']==''){
				delfiledir("../data/upload/tel/".$this->uid);
				unset($_POST['submitbtn']);
				$cert_email = $this->obj->DB_select_once("company_cert","`uid`='".$this->uid."' and `type`='1'");
				if(is_array($cert_email)){
					if($cert_email['check'] != $_POST['linkmail']){
						$row['cert'] = str_replace(",1","",$row['cert']);
						$this->obj->DB_delete_all("company_cert","`id`='".$cert_email['id']."'");
					}
				}
				$cert_tel = $this->obj->DB_select_once("company_cert","`uid`='".$this->uid."' and `type`='2'");
				if(is_array($cert_tel)){
					if($cert_tel['check'] != $_POST['linktel']){
						$row['cert'] = str_replace(",2","",$row['cert']);
						$this->obj->DB_delete_all("company_cert","`id`='".$cert_tel['id']."'");
					}
				}
				unset($_POST['submit']);
				$where['uid']=$this->uid;
				$_POST['lastupdate']=time();
				$nid=$this->obj->update_once("company",$_POST,$where);
				if($nid){
					$data['com_name']=$_POST['name'];
					$data['pr']=$_POST['pr'];
					$data['mun']=$_POST['mun'];
					$data['com_provinceid']=$_POST['provinceid'];
					$this->obj->update_once("company_job",$data,array("uid"=>$this->uid));
					$this->obj->update_once("userid_job",array("com_name"=>$_POST['name']),array("com_id"=>$this->uid));
					$this->obj->update_once("fav_job",array("com_name"=>$_POST['name']),array("com_id"=>$this->uid));
					$this->obj->update_once("report",array("r_name"=>$_POST['name']),array("c_uid"=>$this->uid));
					$this->obj->update_once("blacklist",array("com_name"=>$_POST['name']),array("c_uid"=>$this->uid));
					$this->obj->update_once("msg",array("com_name"=>$_POST['name']),array("job_uid"=>$this->uid));
					$this->member_log("修改企业资料");
					$data['msg']='更新成功！';
				}else{
					$data['msg']='更新失败！';
				}
			}
			$data['url']='index.php?c=info';
			$this->yunset("layer",$data);
		}
		$row=$this->obj->DB_select_once("company","`uid`='".$this->uid."'");
		$this->yunset($this->MODEL('cache')->GetCache(array('city','com','hy')));
		$this->yunset("row",$row);
		$this->waptpl('info');
	}
	function get_com($type)
	{
		$statis=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'");
		if($statis['rating'])
		{
			if($type==1)
			{
				if($statis['vip_etime']>time() || $statis['vip_etime']=="0")
				{
					if($statis['job_num']>0)
					{
						$value="`job_num`=`job_num`-1";
					}else{
						if($this->config['com_integral_online']=="1")
						{
							$this->intergal($type,$statis);
						}else{
							$this->wapheader('index.php?c=job&',"会员发布职位用完,购买会员服务更快捷！");
						}
					}
				}else{
					if($this->config['com_integral_online']=="1")
					{
						$this->intergal($type,$statis);
					}else{
						$this->wapheader('index.php?c=job&',"会员发布职位用完,购买会员服务更快捷！");
					}
				}
			}elseif($type==2){
				if($statis['vip_etime']>time() || $statis['vip_etime']=="0")
				{
					if($statis['editjob_num']>0)
					{
						$value="`editjob_num`=`editjob_num`-1";
					}else{
						if($this->config['com_integral_online']=="1")
						{
							$this->intergal($type,$statis);
						}else{
							$this->wapheader('index.php?c=job&',"会员修改职位用完！");
						}
					}
				}else{
					if($this->config['com_integral_online']=="1")
					{
						$this->intergal($type,$statis);
					}else{
						$this->wapheader('index.php?c=job&',"会员修改职位用完！");
					}
				}
			}
			if($value)
			{
				$this->obj->DB_update_all("company_statis",$value,"`uid`='".$this->uid."'");
			}
		}else{
			$this->intergal($type,$statis);
		}
	}
	function intergal($type,$statis)
	{
		if($type==1 && $this->config['integral_job'])
		{
			if($statis['integral']<$this->config['integral_job'] && $this->config['integral_job_type']=="2")
			{
				$this->wapheader('index.php?c=job&',"你的".$this->config['integral_pricename']."不够发布职位！");
				$auto=false;
			}else{
				$auto=true;
			}
			$nid=$this->company_invtal($this->uid,$this->config['integral_job'],$auto,"发布职位");
		}elseif($type==2 && $this->config['integral_jobedit']){
			if($statis['integral']<$this->config['integral_jobedit'] && $this->config['integral_jobedit_type']=="2")
			{
				$this->wapheader('index.php?c=job&',"你的".$this->config['integral_pricename']."不够修改职位！");
				$auto=false;
			}else{
				$auto=true;
			}
			$nid=$this->company_invtal($this->uid,$this->config['integral_jobedit'],$auto,"修改职位");
		}
	}
	function jobadd_action()
	{
		$this->rightinfo();
		$rows=$this->obj->DB_select_all("company_cert","`uid`='".$this->uid."' group by type order by id desc");
		foreach($rows as $v)
		{
			$row[$v['type']]=$v;
		}
		$msg=array();
		$isallow_addjob="1";
		if($this->config['com_enforce_emailcert']=="1"){
			if($row['1']['status']!="1"){
				$isallow_addjob="0";
				$msg[]="邮箱认证";
			}
		}
		if($this->config['com_enforce_mobilecert']=="1"){
			if($row['2']['status']!="1"){
				$isallow_addjob="0";
				$msg[]="手机认证";
			}
		}
		if($this->config['com_enforce_licensecert']=="1"){
			if($row['3']['status']!="1"){
				$isallow_addjob="0";
				$msg[]="营业执照认证";
			}
		}
		if($this->config['com_enforce_setposition']=="1"){
			$company=$this->obj->DB_select_once("company","`uid`='".$this->uid."'","`x`,`y`");
			if(empty($company['x'])||empty($company['y'])){
				$isallow_addjob="0";
				$msg[]="设置企业地图";
				$url="index.php?c=map";
			}
		}
		if($isallow_addjob=="0"){
			$data['msg']="请先登录电脑客户端完成".pylode("、",$msg)."！";
			$data['url']='index.php';
		}else if($_GET['id']){
			$row=$this->obj->DB_select_once("company_job","`id`='".(int)$_GET['id']."'");
			if($row['lang']!="")
			{
				$row['lang']= @explode(",",$row['lang']);
			}
			if($row['welfare']!="")
			{
				$row['welfare']= @explode(",",$row['welfare']);
			}
			$row['days']= ceil(($row['edate']-$row['sdate'])/86400);
			$this->yunset("row",$row);
		}
		if($_POST['submit']){
			$id=intval($_POST['id']);
			$state= intval($_POST['state']);
			unset($_POST['submit']);
			unset($_POST['id']);
			unset($_POST['state']);
			$_POST['uid']=$this->uid;
			$_POST['lastupdate']=mktime();
			$_POST['state']=$this->config['com_job_status'];
			if($this->config['com_job_status']=="0"){
				$msg="等待审核！";
			}
			if(!empty($_POST['lang']))
			{
				$_POST['lang'] = pylode(",",$_POST['lang']);
			}else{
				$_POST['lang'] = "";
			}
			if(!empty($_POST['welfare']))
			{
				$_POST['welfare'] = pylode(",",$_POST['welfare']);
			}else{
				$_POST['welfare'] = "";
			}
			$com=$this->obj->DB_select_once("company","`uid`='".$this->uid."'");
			$_POST['sdate']=time();
			$_POST['edate']=time()+$_POST['days']*86400;
			unset($_POST['days']);
			$statis=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'");
			$_POST['com_name']=$com['name'];
			$_POST['com_logo']=$com['logo'];
			$_POST['com_provinceid']=$com['provinceid'];
			$_POST['pr']=$com['pr'];
			$_POST['mun']=$com['mun'];
			$_POST['rating']=$statis['rating'];
			$where['id']=$id;
			$where['uid']=$this->uid;
			if(!$id){
				$this->get_com(1);
				$_POST['source']=2;
				$nid=$this->obj->insert_into("company_job",$_POST);
				$name="添加职位";
				if($nid){
					$this->obj->DB_update_all("company","`jobtime`='".$_POST['lastupdate']."'","`uid`='".$this->uid."'");
					$state_content = "发布了新职位 <a href=\"".Url("job",array("c"=>"comapply","id"=>$nid))."\" target=\"_blank\">".$_POST['name']."</a>。";
					$this->addstate($state_content);
					$this->member_log("发布了新职位 ".$_POST['name']);
				}
			}else{
				if($state=="1" || $state=="2"){
					$this->get_com(2);
				}
				$rows=$this->obj->DB_select_once("company_job","`id`='".$id."'");
				$nid=$this->obj->update_once("company_job",$_POST,$where);
				$name="更新职位";
				if($nid){
					$this->obj->DB_update_all("company","`jobtime`='".$_POST['lastupdate']."'","`uid`='".$this->uid."'");
					$this->member_log("更新基本信息".$_POST['name']);
				}
			}
			$nid?$data['msg']=$name."成功！":$data['msg']=$name."失败！";
			$data['url']='index.php?c=job';
		}
		$this->yunset("layer",$data);
		$this->yunset($this->MODEL('cache')->GetCache(array('city','com','hy','job')));
		$this->waptpl('jobadd');
	}
	function job_action()
	{
		$this->rightinfo();
		$urlarr=array("c"=>"job","page"=>"{{page}}");
		$pageurl=Url('wap',$urlarr,'member');
		$this->get_page("company_job","`uid`='".$this->uid."'",$pageurl,"10");
		$this->waptpl('job');
	}
	function jobset_action(){
		if($_GET['status']){
			$this->obj->update_once('company_job',array('status'=>intval($_GET['status'])),array('uid'=>$this->uid,'id'=>intval($_GET['id'])));
			$this->member_log("修改职位招聘状态");
			$this->waplayer_msg("设置成功！");
		}
	}

	function jobdel_action(){
		if($_GET['id']){
			$nid=$this->obj->DB_delete_all("company_job","`id`='".(int)$_GET['id']."' and `uid`='".$this->uid."'");
			if($nid){
				$this->member_log("删除职位记录(ID:".(int)$_GET['id'].")");
				$this->waplayer_msg("删除成功！");
			}else{
				$this->waplayer_msg("删除失败！");
			}
		}
	}
	function hr_action()
	{
		$this->rightinfo();
		$urlarr=array("c"=>"hr","page"=>"{{page}}");
		$pageurl=Url('wap',$urlarr,'member');
		$rows=$this->get_page("userid_job","`com_id`='".$this->uid."'",$pageurl,"10");
		if(is_array($rows) && !empty($rows)){
			$uid=$eid=array();
			foreach($rows as $v){
				$uid[]=$v['uid'];
				$eid[]=$v['eid'];
			}
			$userrows=$this->obj->DB_select_all("resume","`uid` in (".pylode(",",$uid).") and `r_status`<>'2'","`name`,`sex`,`edu`,`uid`,`exp`");
			$yqlist=$this->obj->DB_select_all("userid_msg","`uid` in (".pylode(",",$uid).")","`uid`");
			$expect=$this->obj->DB_select_all("resume_expect","`id` in (".pylode(",",$eid).")","`id`,`job_classid`,`salary`");

			if(is_array($userrows)){
				include(PLUS_PATH."user.cache.php");
				include(PLUS_PATH."job.cache.php");
				$expectinfo=array();
				foreach($expect as $key=>$val){
					$jobids=@explode(',',$val['job_classid']);
					$jobname=array();
					foreach($jobids as $v){
						$jobname[]=$job_name[$v];
					}
					$expectinfo[$val['id']]['jobname']=@implode('、',$jobname);
					$expectinfo[$val['id']]['salary']=$userclass_name[$val['salary']];
				}
				foreach($rows as $k=>$v){
					$rows[$k]['jobname']=$expectinfo[$v['eid']]['jobname'];
					$rows[$k]['salary']=$expectinfo[$v['eid']]['salary'];
					foreach($userrows as $val){
						if($v['uid']==$val['uid']){
							$rows[$k]['name']=$val['name'];
							$rows[$k]['sex']=$userclass_name[$val['sex']];
							$rows[$k]['edu']=$userclass_name[$val['edu']];
							$rows[$k]['exp']=$userclass_name[$val['exp']];
						}
					}
					foreach($yqlist as $val){
						if($v['uid']==$val['uid']){
							$rows[$k]['yq']=1;
						}
					}
				}
			}
		}
		$this->yunset("rows",$rows);
		$this->waptpl('hr');
	}
	function hrset_action(){
		if((int)$_GET['id']&&(int)$_GET['browse']){
			$nid=$this->obj->update_once("userid_job",array('is_browse'=>(int)$_GET['browse']),array("com_id"=>$this->uid,"id"=>(int)$_GET['id']));
			$this->member_log("更改申请职位状态(ID:".(int)$_GET['id'].")");
			$nid?$this->waplayer_msg("操作成功！"):$this->waplayer_msg("操作失败！");
		}
	}
	function delhr_action(){
		$nid=$this->obj->DB_delete_all("userid_job","`id`='".(int)$_GET['id']."' and `com_id`='".$this->uid."'");
		$this->member_log("删除申请职位记录(ID:".(int)$_GET['id'].")");
		$nid?$this->waplayer_msg("删除成功！"):$this->waplayer_msg("删除失败！");
	}
	function password_action(){
		$this->rightinfo();
		if($_POST['submit']){
			$member=$this->obj->DB_select_once("member","`uid`='".$this->uid."'");
			$pw=md5(md5($_POST['oldpassword']).$member['salt']);
			if($pw!=$member['password']){
				$data['msg']="旧密码不正确，请重新输入！";
			}else if(strlen($_POST['password1'])<6 || strlen($_POST['password1'])>20){
				$data['msg']="密码长度应在6-20位！";
			}elseif($_POST['password1']!=$_POST['password2']){
				$data['msg']="新密码和确认密码不一致！";
			}elseif($this->config['sy_uc_type']=="uc_center" && $member['name_repeat']!="1"){
				$this->uc_open();
				$ucresult= uc_user_edit($member['username'], $_POST['oldpassword'], $_POST['password1'], "","1");
				if($ucresult == -1){
					$data['msg']="旧密码不正确，请重新输入！";
				}
			}else{
				$salt = substr(uniqid(rand()), -6);
				$pass2 = md5(md5($_POST['password1']).$salt);
				$this->obj->DB_update_all("member","`password`='".$pass2."',`salt`='".$salt."'","`uid`='".$this->uid."'");
				SetCookie("uid","",time() -286400, "/");
				SetCookie("username","",time() - 86400, "/");
				SetCookie("salt","",time() -86400, "/");
				SetCookie("shell","",time() -86400, "/");
				$this->member_log("修改密码");
				$data['msg']="修改成功，请重新登录！";
				$data['url']=$this->config['sy_weburl'].'/wap/index.php?m=login';
			}
            $this->waplayer_msg($data['msg'],$data['url']);
		}
		$this->waptpl('password');
	}
	function pay_action(){
		$statis=$this->company_satic();
		if($_POST['usertype']=='price')
		{
			$rows=$this->obj->DB_select_all("company_rating","`service_price`<>'' and `display`='1' and `category`=1 order by sort desc","name,service_price,id");
			$this->yunset("rows",$rows);
		}
		$this->yunset("statis",$statis);
		$remark="姓名：\n联系电话：\n留言：";
		$this->yunset("remark",$remark);
		$this->yunset("js_def",4);
		$this->waptpl('pay');
	}
	function company_satic()
	{
		$statis=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'");
		if($statis['vip_etime']<time()){
			$rating=$this->obj->DB_select_once("company_rating","`id`='".$statis['rating']."'");
			if($rating['type']=='1'){
				$nums=$statis['job_num']+$statis['editjob_num']+$statis['breakjob_num']+$statis['down_resume'];
			}else{
				$nums=0;
			}
			if($nums<1){
				$data['rating_name']="非会员";
				$data['rating']="";
				$data['vip_etime']="";
				$where['uid']=$this->uid;
				$this->obj->update_once("company_statis",$data,$where);
			}
		}
		if($statis['autotime']>=time()){

			$statis['auto'] = 1;
		}
		$statis['pay_format']=number_format($statis['pay'],2);
		$this->yunset("statis",$statis);
		return $statis;
	}
	function yq_action(){
		$rows=$this->obj->DB_select_all("company_job","`uid`='".$this->uid."' and `edate`>'".time()."' and `sdate`<'".time()."'  and `status`<>1 and `state`=1","`id`,`name`,`link_type`");
		$company=$this->obj->DB_select_once("company","`uid`='".$this->uid."'","`linkman`,`linktel`,`address`");
		$Info=$this->obj->DB_select_once("resume_expect","`uid`='".$_GET['uid']."'","`id`,`uid`,`name`");
		if($rows['2']){
			$link=$this->obj->DB_select_once("company_job_link","`jobid`='".$rows['id']."'");
			$company['linkman']=$link['link_man'];
			$company['linktel']=$link['link_moblie'];
		}
		$this->yunset("Info",$Info);
		$this->yunset("company",$company);
		$this->yunset("rows",$rows);
		$this->waptpl('yq');
	}
	function dingdan_action(){
		if($_POST['price']){
			if($_POST['comvip']){
				$comvip=(int)$_POST['comvip'];
				$ratinginfo =  $this->obj->DB_select_once("company_rating","`id`='".$comvip."'");
				$price = $ratinginfo['service_price'];
				$data['type']='1';
			}elseif($_POST['price_int']){
				$price = $_POST['price_int']/$this->config['integral_proportion'];
				$data['type']='2';
			}elseif($_POST['price_msg']){
				$price = $_POST['price_msg']/$this->config['integral_msg_proportion'];
				$data['type']='5';
			}
			$dingdan=mktime().rand(10000,99999);
			$data['order_id']=$dingdan;
			$data['order_price']=$price;
			$data['order_time']=mktime();
			$data['order_state']="1";
			$data['order_remark']=trim($_POST['remark']);
			$data['uid']=$this->uid;
			$data['rating']=$_POST['comvip'];
			$data['integral']=$_POST['price_int'];
			$id=$this->obj->insert_into("company_order",$data);
			if($id){
				$this->member_log("下单成功,订单ID".$dingdan);
				$_POST['dingdan']=$dingdan;
				$_POST['dingdanname']=$dingdan;
				$_POST['alimoney']=$price;
				$data['msg']="下单成功，请付款！";
				$data['url']=$this->config['sy_weburl'].'/api/wapalipay/alipayto.php?dingdan='.$dingdan.'&dingdanname='.$dingdanname.'&alimoney='.$price;
			}else{
				$data['msg']="提交失败，请重新提交订单！";
				$data['url']=$_SERVER['HTTP_REFERER'];
			}
		}else{
			$data['msg']="参数不正确，请正确填写！";
			$data['url']=$_SERVER['HTTP_REFERER'];
		}
		$this->yunset("layer",$data);
		$this->waptpl('pay');
	}
	function look_job_action(){
		$urlarr['c']='look_job';
		$urlarr["page"]="{{page}}";
		$pageurl=Url('wap',$urlarr,'member');
		$rows=$this->get_page("look_job","`com_id`='".$this->uid."' and `com_status`='0' order by datetime desc",$pageurl,"10");
		if(is_array($rows))
		{
			foreach($rows as $v)
			{
				$uid[]=$v['uid'];
				$jobid[]=$v['jobid'];
			}
			$resume=$this->obj->DB_select_all("resume","`uid` in (".pylode(",",$uid).")","`uid`,`name`,`edu`,`exp`,`sex`,`def_job` as `eid`");
			$job=$this->obj->DB_select_all("company_job","`id` in (".pylode(",",$jobid).")","`id`,`name`");
			$userid_msg=$this->obj->DB_select_all("userid_msg","`fid`='".$this->uid."' and `uid` in (".pylode(",",$uid).")","uid");
			include(PLUS_PATH."user.cache.php");
			foreach($resume as $val){
				$eid[]=$val['eid'];
			}
			$expect=$this->obj->DB_select_all("resume_expect","`id` in (".pylode(",",$eid).")","`id`,`uid`,`salary`");
			foreach($rows as $key=>$val)
			{
				foreach($expect as $v){
					if($val['uid']==$v['uid']){
						$rows[$key]['salary']=$userclass_name[$v['salary']];
					}
				}
				foreach($resume as $va)
				{
					if($val['uid']==$va['uid'])
					{
						$rows[$key]['sex']=$userclass_name[$va['sex']];
						$rows[$key]['exp']=$userclass_name[$va['exp']];
						$rows[$key]['edu']=$userclass_name[$va['edu']];
						$rows[$key]['name']=$va['name'];
					}
				}
				foreach($job as $va)
				{
					if($val['jobid']==$va['id'])
					{
						$rows[$key]['jobname']=$va['name'];
					}
				}
				foreach($userid_msg as $va)
				{
					if($val['uid']==$va['uid'])
					{
						$rows[$key]['userid_msg']=1;
					}
				}
			}
		}
		$this->yunset("rows",$rows);
		$this->yunset("js_def",5);
		$this->waptpl('look_job');
	}
	function lookresumedel_action(){
		if($_GET['id']){
			$nid=$this->obj->DB_update_all("look_resume","`com_status`='1'","`id`='".(int)$_GET['id']."' and `com_id`='".$this->uid."'");
			if($nid){
				$this->member_log("删除已浏览简历记录(ID:".(int)$_GET['id'].")");
				$this->waplayer_msg('删除成功！');
			}else{
				$this->waplayer_msg('删除失败！');
			}
		}
	}
	function lookjobdel_action(){
		if($_GET['id']){
			$nid=$this->obj->DB_update_all("look_job","`com_status`='1'","`id`='".(int)$_GET['id']."' and `com_id`='".$this->uid."'");
			if($nid){
				$this->member_log("删除已浏览简历记录(ID:".(int)$_GET['id'].")");
				$this->waplayer_msg('删除成功！');
			}else{
				$this->waplayer_msg('删除失败！');
			}
		}
	}

	function look_resume_action(){
		$urlarr['c']='look_resume';
		$urlarr["page"]="{{page}}";
		$pageurl=Url('wap',$urlarr,'member');
		$rows=$this->get_page("look_resume","`com_id`='".$this->uid."' and `com_status`='0' order by datetime desc",$pageurl,"10");
		if(is_array($rows)){
			foreach($rows as $v){
				$resume_id[]=$v['resume_id'];
				$uid[]=$v['uid'];
			}
			$resume=$this->obj->DB_select_alls("resume","resume_expect","a.uid=b.uid and b.`id` in (".pylode(",",$resume_id).")","a.`name`,a.`sex`,a.`exp`,a.`edu`,b.`id`,b.job_classid,b.`salary`");
			$userid_msg=$this->obj->DB_select_all("userid_msg","`fid`='".$this->uid."' and `uid` in (".pylode(",",$uid).")","uid");
			if(is_array($resume)){
				include(PLUS_PATH."user.cache.php");
				include(PLUS_PATH."job.cache.php");
				foreach($rows as $key=>$val){
					foreach($resume as $va){
						if($val['resume_id']==$va['id']){
							$rows[$key]['name']=$va['name'];
							$rows[$key]['salary']=$userclass_name[$va['salary']];
							$rows[$key]['sex']=$userclass_name[$va['sex']];
							$rows[$key]['exp']=$userclass_name[$va['exp']];
							$rows[$key]['edu']=$userclass_name[$va['edu']];
							if($va['job_classid']!=""){
								$job_classid=@explode(",",$va['job_classid']);
								$rows[$key]['jobname']=$job_name[$job_classid[0]];
							}
						}
					}
					foreach($userid_msg as $va){
						if($va['uid']&&$val['uid']&&$val['uid']==$va['uid']){
							$rows[$key]['userid_msg']=1;
						}
					}
				}
			}
		}
		$this->yunset("rows",$rows);
		$this->yunset("js_def",5);
		$this->waptpl('look_resume');
	}
	function talent_pool_remark_action()
	{
		if($_POST['remark']=="")
		{
			$this->ACT_layer_msg("备注内容不能为空！",8,$_SERVER['HTTP_REFERER']);
		}else{
			$nid=$this->obj->DB_update_all("talent_pool","`remark`='".$_POST['remark']."'","`id`='".(int)$_POST['id']."'");
			if($nid)
			{
				$this->member_log("备注人才".$_POST['r_name']);
				$data['msg']="备注成功！";
				$data['url']=$this->config['sy_weburl'].'/wap/member/index.php?c=talent_pool';
			}else{
				$data['msg']="备注失败！";
				$data['url']=$this->config['sy_weburl'].'/wap/member/index.php?c=talent_pool';
			}
		}
		$this->yunset("layer",$data);
		$this->waptpl('talent_pool');
	}
	function talentpooldel_action(){
		if($_GET['id']){
			$nid=$this->obj->DB_delete_all("talent_pool","`id`='".(int)$_GET['id']."' and `cuid`='".$this->uid."'");
			if($nid){
				$this->member_log("删除收藏简历人才(ID:".(int)$_GET['id'].")");
				$this->waplayer_msg('删除成功！');
			}else{
				$this->waplayer_msg('删除失败！');
			}
		}
	}
	function talent_pool_action()
	{
		$where="`cuid`='".$this->uid."'";
		$urlarr['c']='talent_pool';
		$urlarr["page"]="{{page}}";
		$pageurl=Url('wap',$urlarr,'member');
		$rows=$this->get_page("talent_pool",$where."  order by id desc",$pageurl,"10");
		if(is_array($rows)) {
			foreach($rows as $v) {
				$uid[]=$v['uid'];
			}
			$resume=$this->obj->DB_select_alls("resume","resume_expect","a.uid=b.uid and a.`r_status`<>'2' and a.uid in (".pylode(',',$uid).")","a.`name`,a.`uid`,a.`sex`,a.`exp`,b.`job_classid`,b.id as eid,b.salary");

			$userid_msg=$this->obj->DB_select_all("userid_msg","`fid`='".$this->uid."' and `uid` in (".pylode(",",$uid).")","uid");
			if(is_array($resume)) {
				include(PLUS_PATH."user.cache.php");
				include(PLUS_PATH."job.cache.php");
				foreach($rows as $key=>$val) {
					foreach($resume as $va) {
						if($val['uid']==$va['uid'])
						{
							$rows[$key]['eid']=$va['eid'];
							$rows[$key]['name']=$va['name'];
							$rows[$key]['salary']=$userclass_name[$va['salary']];
							$rows[$key]['sex']=$userclass_name[$va['sex']];
							$rows[$key]['exp']=$userclass_name[$va['exp']];
							if($va['job_classid']!="")
							{
								$job_classid=@explode(",",$va['job_classid']);
								$rows[$key]['jobname']=$job_name[$job_classid[0]];
							}
						}
					}
					foreach($userid_msg as $va)
					{
						if($val['uid']==$va['uid'])
						{
							$rows[$key]['userid_msg']=1;
						}
					}
				}
			}
		}
		$this->yunset("rows",$rows);
		$report=$this->config['com_report'];
		$this->yunset("report",$report);
		$this->company_satic();
		$this->yunset("js_def",5);
		$this->waptpl('talent_pool');
	}
	function invite_action(){
		$urlarr['c']='invite';
		$urlarr["page"]="{{page}}";
		$pageurl=Url('wap',$urlarr,'member');
		$rows=$this->get_page("userid_msg"," `fid`='".$this->uid."' order by id desc",$pageurl,"10");
		if(is_array($rows) && !empty($rows)){
			foreach($rows as $v){
				$uid[]=$v['uid'];
			}
			$resume=$this->obj->DB_select_all("resume","`uid` in (".pylode(",",$uid).") and `r_status`<>'2'","`uid`,`name`,`exp`,`edu`,`def_job` as `eid`");
			foreach($resume as $val){
				$eid[]=$val['eid'];
			}
			$expect=$this->obj->DB_select_all("resume_expect","`id` in (".pylode(",",$eid).")","`salary`,`id`");
			if(is_array($resume)){
				$user=array();
				include(PLUS_PATH."user.cache.php");
				foreach($resume as $val){
					foreach($expect as $v){
						if($v['id']==$val['eid']){
							$user[$val['uid']]['salary']=$userclass_name[$v['salary']];
						}
					}
					$user[$val['uid']]['eid']=$val['eid'];
					$user[$val['uid']]['name']=$val['name'];
					$user[$val['uid']]['exp']=$userclass_name[$val['exp']];
					$user[$val['uid']]['edu']=$userclass_name[$val['edu']];
				}
			}

			$this->yunset("user",$user);
		}
		$this->yunset("rows",$rows);
		$this->yunset("js_def",5);
		$this->waptpl('invite');
	}
	function invite_del_action(){
		if($_GET['id']){
			$nid=$this->obj->DB_delete_all("userid_msg","`id`='".(int)$_GET['id']."' and `fid`='".$this->uid."'"," ");
			if($nid){
				$this->member_log("删除已邀请面试的人才",4,3);
				$this->waplayer_msg('删除成功！');
			}else{
				$this->waplayer_msg('删除失败！');
			}
		}
	}
}
?>