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
class index_controller extends wap_controller{
	function waptpl($tpname){
		$this->yuntpl(array('wap/member/user/'.$tpname));
	}
	function index_action(){
		$this->rightinfo();
		$looknum=$this->obj->DB_select_num("look_resume","`uid`='".$this->uid."' and `status`='0'");
		$look_jobnum=$this->obj->DB_select_num("look_job","`uid`='".$this->uid."' and `status`='0'");
		$this->yunset("looknum",$looknum);
		$this->yunset("look_jobnum",$look_jobnum);
		$yqnum=$this->obj->DB_select_num("userid_msg","`uid`='".$this->uid."'");
		$this->yunset("yqnum",$yqnum);
		$statis=$this->obj->DB_select_once("member_statis","`uid`='".$this->uid."'");
		$resume_num=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."'");
		$this->yunset("resume_num",$resume_num);
		$sq_nums=$this->obj->DB_select_num("userid_job","`uid`='".$this->uid."' ");
		$statis['sq_jobnum']=$sq_nums;
		$expect=$this->obj->DB_select_once("resume_expect","`uid`='".$this->uid."' and `defaults`='1'","integrity,id");
		$this->yunset("expect",$expect);
		$this->yunset("statis",$statis);
		$this->waptpl('index');
	}
	function sq_action(){
		$this->rightinfo();
		$urlarr=array("c"=>"sq","page"=>"{{page}}");
		$pageurl=Url('wap',$urlarr,'member');
		$rows=$this->get_page("userid_job","`uid`='".$this->uid."'",$pageurl,"10");
		if(is_array($rows)){
			foreach($rows as $v){
				$com_id[]=$v['com_id'];
			}
			$company=$this->obj->DB_select_all("company","`uid` in (".pylode(",",$com_id).")","cityid,uid,name");
			include PLUS_PATH."/city.cache.php";
			foreach($rows as $k=>$v){
				foreach($company as $val){
					if($v['com_id']==$val['uid']){
						$rows[$k]['city']=$city_name[$val['cityid']];
                        $rows[$k]['com_name']=$val['name'];
					}
				}
			}
		}
		$this->yunset("rows",$rows);
		$this->waptpl('sq');
	}
	function delsq_action(){
		if($_GET['id']){
			$userid_job=$this->obj->DB_select_once("userid_job","`id`='".(int)$_GET['id']."' and `uid`='".$this->uid."'");
			$id=$this->obj->DB_delete_all("userid_job","`id`='".(int)$_GET['id']."' and `uid`='".$this->uid."'");
			if($id){
				$this->obj->DB_update_all('company_statis',"`sq_job`=`sq_job`-1","`uid`='".$userid_job['com_id']."'");
				$this->obj->DB_update_all('member_statis',"`sq_jobnum`=`sq_jobnum`-1","`uid`='".$userid_job['uid']."'");
				$this->member_log("删除申请的职位");
				$this->waplayer_msg('删除成功！');
			}else{
				$this->waplayer_msg('删除失败！');
			}
		}
	}
	function collect_action(){
		$this->rightinfo();
		if($_GET['del']){
			$id=$this->obj->DB_delete_all("fav_job","`id`='".$_GET['del']."' and `uid`='".$this->uid."'");
			if($id){
				$data['msg']="删除成功!";
				$this->obj->DB_update_all("member_statis","`fav_jobnum`=`fav_jobnum`-1","uid='".$this->uid."'");
				$this->member_log("删除收藏的职位");
			}else{
				$data['msg']="删除失败！";
			}
			$data['url']='index.php?c=collect';
			$this->yunset("layer",$data);
		}
		$urlarr=array("c"=>"collect","page"=>"{{page}}");
		$pageurl=Url('wap',$urlarr,'member');
		$this->get_page("fav_job","`uid`='".$this->uid."'",$pageurl,"10");
		$this->waptpl('collect');
	}
	function password_action(){
		if($_POST['submit']){
			$member=$this->obj->DB_select_once("member","`uid`='".$this->uid."'");
			$pw=md5(md5($_POST['oldpassword']).$member['salt']);
			if($pw!=$member['password']){
				$data['msg']="旧密码不正确，请重新输入！";
			}else if(strlen($_POST['password1'])<6 || strlen($_POST['password1'])>20){
				$data['msg']="密码长度应在6-20位！";
			}else if($_POST['password1']!=$_POST['password2']){
				$data['msg']="新密码和确认密码不一致！";
			}else if($this->config['sy_uc_type']=="uc_center" && $member['name_repeat']!="1"){
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
		$this->rightinfo();
		$this->waptpl('password');
	}
	function invitecont_action(){
		$this->rightinfo();
		$id=(int)$_GET['id'];
		$info=$this->obj->DB_select_once("userid_msg","`id`='".$id."' and `uid`='".$this->uid."'");
		if($info['is_browse']==1){
			$this->obj->update_once("userid_msg",array('is_browse'=>2),array("id"=>$info['id']));
		}
		$this->yunset("info",$info);
		$this->waptpl('invitecont');
	}
	function inviteset_action(){
		$id=(int)$_GET['id'];
		$browse=(int)$_GET['browse'];
		if($id){
			$nid=$this->obj->update_once("userid_msg",array('is_browse'=>$browse),array("id"=>$id,"uid"=>$this->uid));
			$nid?$this->waplayer_msg("操作成功！"):$this->waplayer_msg("操作失败！");
		}
	}
	function invite_action(){
		$this->rightinfo();
		if($_GET['del'])
		{
			$id=$this->obj->DB_delete_all("userid_msg","`id`='".(int)$_GET['del']."' and `uid`='".$this->uid."'");
			if($id)
			{
				$this->member_log("删除邀请信息");
				$data['msg']="删除成功!";
			}else{
				$data['msg']="删除失败!";
			}
			$data['url']='index.php?c=invite';
			$this->yunset("layer",$data);
		}
		$urlarr=array("c"=>"invite","page"=>"{{page}}");
		$pageurl=Url('wap',$urlarr,'member');
		$this->get_page("userid_msg","`uid`='".$this->uid."'",$pageurl,"10");
		$this->waptpl('invite');
	}
	function look_action()
	{
		$this->rightinfo();
		if($_GET['del'])
		{
			$id=$this->obj->DB_delete_all("look_resume","`id`='".(int)$_GET['del']."' and `uid`='".$this->uid."'");
			if($id)
			{
				$data['msg']="删除成功!";
				$this->member_log("删除简历浏览记录");
			}else{
				$data['msg']="删除失败!";
			}
			$data['url']='index.php?c=look';
			$this->yunset("layer",$data);
		}
		$urlarr=array("c"=>"look","page"=>"{{page}}");
		$pageurl=Url('wap',$urlarr,'member');
		$rows=$this->get_page("look_resume","`uid`='".$this->uid."'",$pageurl,"10");
		if(is_array($rows))
		{
			foreach($rows as $v)
			{
				$uid[]=$v['com_id'];
				$eid[]=$v['resume_id'];
			}
			$company=$this->obj->DB_select_all("company","`uid` in (".pylode(",",$uid).")","`uid`,`name`");
			$resume=$this->obj->DB_select_all("resume_expect","`id` in (".pylode(",",$eid).")","`id`,`name`");
			foreach($rows as $k=>$v)
			{
				foreach($company as $val)
				{
					if($v['com_id']==$val['uid'])
					{
						$rows[$k]['com_name']=$val['name'];
					}
				}
				foreach($resume as $val)
				{
					if($v['resume_id']==$val['id'])
					{
						$rows[$k]['resume_name']=$val['name'];
					}
				}
			}
		}
		$this->yunset("rows",$rows);
		$this->waptpl('look');
	}

	function addresume_action()
	{
		$this->rightinfo();
		if($this->config['user_enforce_identitycert']=="1")
		{
			$row=$this->obj->DB_select_once("resume","`idcard_pic`<>'' and `uid`='".$this->uid."'");
			if($row['idcard_status']!="1")
			{
				$data['msg']='请先登录电脑客户端完成身份认证！';
				$data['url']='index.php';
				$this->yunset("layer",$data);
			}
		}
		if($_POST['submit'])
		{
			$num=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."'");
			if($num>=$this->config['user_number']){
				$data['msg']='你的简历数已经超过系统设置的简历数了！';
				$data['url']='index.php?c=resume';
			}
			$email=$this->obj->DB_select_num("member","`uid`<>'".$this->uid."' and `email`='".$_POST['email']."'","`uid`");
			if($email && $data['msg']==""){
				$data['msg']='邮箱已存在！';
			}
            $mobile=$this->obj->DB_select_once("member","`uid`<>'".$this->uid."' and `moblie`='".$_POST['telphone']."'","`uid`");
			if($mobile && $data['msg']==""){
				$data['msg']='手机已存在！';
			}
			if($_POST['uname']=="" && $data['msg']==""){
				$data['msg']='姓名不能为空！';
			}
			if($_POST['birthday']=="" && $data['msg']==""){
				$data['msg']='出生年月不能为空！';
			}
			if($_POST['living']=="" && $data['msg']==""){
				$data['msg']='现居住地不能为空！';
			}
			if($_POST['name']=="" && $data['msg']==""){
				$data['msg']='简历名称不能为空！';
			}
			if($_POST['job_classid']=="" && $data['msg']==""){
				$data['msg']='期望从事职位不能为空！';
			}
			if($_POST['cityid']=="" && $data['msg']==""){
				$data['msg']='期望工作地点不能为空！';
			}
			if($data['msg']==""){
				unset($_POST['submit']);
				delfiledir("../data/upload/tel/".$this->uid);
				$where['uid']=$this->uid;
				$data['idcard']=$_POST['idcard'];
				$data['edu']=$_POST['edu'];
				$data['exp']=$_POST['exp'];
				$data['name']=$_POST['uname'];
				$data['sex']=$_POST['sex'];
				$data['birthday']=$_POST['birthday'];
				$data['telphone']=$_POST['telphone'];
				$data['email']=$_POST['email'];
				$data['living']=$_POST['living'];
				$nid=$this->obj->update_once("resume",$data,$where);
				if($nid){
					$this->obj->update_once("member",array('email'=>$_POST['email'],'moblie'=>$_POST['telphone']),$where);
					$resume=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'");
					if($resume['name']==""||$resume['living']=="")
					{
						$this->MODEL('userinfo')->company_invtal($this->uid,$this->config['integral_userinfo'],true,"首次填写基本资料",true,2,'integral',25);
					}
					$resume=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'");
					$edata['idcard_status']=$resume['idcard_status'];
					$edata['status']=$resume['status'];
					$edata['r_status']=$resume['r_status'];
					$edata['photo']=$resume['photo'];
					$edata['edu']=$resume['edu'];
					$edata['exp']=$resume['exp'];
					$edata['uname']=$resume['name'];
					$edata['sex']=$resume['sex'];
					$edata['birthday']=$resume['birthday'];
					$edata['name']=$_POST['name'];
					$edata['jobstatus']=$_POST['jobstatus'];
					$edata['report']=$_POST['report'];
					$edata['hy']=$_POST['hy'];
					$edata['job_classid']=$_POST['job_classid'];
					$edata['salary']=$_POST['salary'];
					$edata['provinceid']=$_POST['provinceid'];
					$edata['cityid']=$_POST['cityid'];
					$edata['three_cityid']=$_POST['three_cityid'];
					$edata['uid']=$this->uid;
					$edata['integrity']=55;
					$edata['lastupdate']=time();
					$edata['ctime']=time();
					$edata['source']=2;
					$edata['defaults']=$num<=0?1:0;
					$eid=$this->obj->insert_into("resume_expect",$edata);
					if($num==0){
						$this->obj->update_once('resume',array('def_job'=>$eid),array('uid'=>$this->uid));
					}
					$this->obj->insert_into("user_resume",array("eid"=>$eid,"uid"=>$this->uid,"expect"=>1));
					$this->obj->DB_update_all('member_statis',"`resume_num`=`resume_num`+1","`uid`='".$this->uid."'");
					$resume_url=Url("resume",array("c"=>"show","id"=>$eid));
					$state_content = "发布了 <a href=\"".$resume_url."\" target=\"_blank\">新简历</a>。";
					$fdata['uid']	  = $this->uid;
					$fdata['content'] = $state_content;
					$fdata['ctime']   = time();
					$fdata['type']   = 2;
					$this->obj->insert_into("friend_state",$fdata);
					$this->obj->member_log("创建一份简历",2,1);
					$data['msg']='添加成功！';
					$data['url']='index.php?c=resume';
				}else{
					$data['msg']='保存失败！';
				}
			}
			if($data['url']==""){
				$data['url']="index.php?c=addresume";
			}
			$this->yunset("layer",$data);
		}
		$resume=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'");
		$this->yunset("resume",$resume);
        $this->yunset($this->MODEL('cache')->GetCache(array('city','user','hy','job')));
		$this->waptpl('addresume');
	}
	function addresumeson_action(){
		$this->rightinfo();
		if(!in_array($_GET['type'],array('expect','cert','doc','edu','other','project','show','skill','tiny','training','work'))){
				unset($_GET['type']);
		}
		if($_GET['type']=="desc")
		{
			$desc=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'","`description`");
			$this->yunset("description",$desc['description']);
		}
		if($_GET['id'] && $_GET['type']){
			$row=$this->obj->DB_select_once("resume_".$_GET['type'],"`id`='".(int)$_GET['id']."' and `uid`='".$this->uid."'");
			$this->yunset("row",$row);
		}
		$this->user_cache();
        $this->getYears(1900,(int)date("Y"));
		$this->waptpl('addresumeson');
	}
	function saveresumeson_action()
	{
		if($_POST['submit']){
			$_POST=$this->post_trim_iconv($_POST);
			if($_POST['table']=="resume"){
				$this->obj->DB_update_all("resume","`description`='".$_POST['description']."'","`uid`='".$this->uid."'");
				$data['url']="index.php?c=modify&eid=".$_POST['eid'];
				$data['msg']=iconv('gbk','utf-8',"保存成功！");
				echo json_encode($data);die;
			}
			if($_POST['eid']>0){
				$table="resume_".$_POST['table'];
				$id=(int)$_POST['id'];
				$url=$_POST['table'];
				unset($_POST['submit']);
				unset($_POST['table']);
				unset($_POST['id']);
				if($_POST['syear'])
				{
					$_POST['sdate']=strtotime($_POST['syear']."-".$_POST['smouth']."-".$_POST['sday']);
					$_POST['edate']=strtotime($_POST['eyear']."-".$_POST['emouth']."-".$_POST['eday']);
					unset($_POST['syear']);
					unset($_POST['smouth']);
					unset($_POST['sday']);
					unset($_POST['eyear']);
					unset($_POST['emouth']);
					unset($_POST['eday']);
				}
				if($id)
				{
					$where['id']=$id;
					$where['uid']=$this->uid;
					$nid=$this->obj->update_once($table,$_POST,$where);
				}else{
					$_POST['uid']=$this->uid;
					$nid=$this->obj->insert_into($table,$_POST);
					$this->obj->DB_update_all("user_resume","`$url`=`$url`+1","`eid`='".(int)$_POST['eid']."' and `uid`='".$this->uid."'");
					$resume_row=$this->obj->DB_select_once("user_resume","`eid`='".(int)$_POST['eid']."'");
					$this->complete($resume_row);
				}
				$nid?$data['msg']='保存成功！':$data['msg']='保存失败！';
				$data['url']="index.php?c=rinfo&eid=".$_POST['eid']."&type=".$url;
				$data['msg']=iconv('gbk','utf-8',$data['msg']);
				echo json_encode($data);die;
			}
		}
	}
	function post_trim_iconv($data){
		foreach($data as $d_k=>$d_v){
			if(is_array($d_v)){
				$data[$d_k]=$this->post_trim_iconv($d_v);
			}else{
				$data[$d_k]=iconv("UTF-8","GBK",trim($data[$d_k]));
			}
		}
		return $data;
	}
	function get_email_moblie_action(){
		$data['msg']=1;
		$email=$this->obj->DB_select_num("member","`uid`<>'".$this->uid."' and `email`='".$_POST['email']."'","`uid`");
		if($email){
			$data['msg']='邮箱已存在！';
		}
        $mobile=$this->obj->DB_select_once("member","`uid`<>'".$this->uid."' and `moblie`='".$_POST['moblie']."'","`uid`");
		if($mobile){
			$data['msg']='手机已存在！';
		}
		$data['msg']=iconv('gbk','utf-8',$data['msg']);
		echo json_encode($data);die;
	}
	function info_action()
	{
		$this->rightinfo();
		if($_POST['submit']){
			$email=$this->obj->DB_select_num("member","`uid`<>'".$this->uid."' and `email`='".$_POST['email']."'","`uid`");
			if($email){
				$data['msg']='邮箱已存在！';
			}
            $mobile=$this->obj->DB_select_once("member","`uid`<>'".$this->uid."' and `moblie`='".$_POST['telphone']."'","`uid`");
			if($mobile && $data['msg']==""){
				$data['msg']='手机已存在！';
			}
			if($_POST['name']=="" && $data['msg']==""){
				$data['msg']='姓名不能为空！';
			}
			if($_POST['birthday']=="" && $data['msg']==""){
				$data['msg']='出生年月不能为空！';
			}
			if($_POST['living']=="" && $data['msg']==""){
				$data['msg']='现居住地不能为空！';
			}
			if($data['msg']==""){
				unset($_POST['submit']);
				delfiledir("../data/upload/tel/".$this->uid);
				$where['uid']=$this->uid;
				$nid=$this->obj->update_once("resume",$_POST,$where);
				if($nid){
					$this->obj->update_once("member",array('email'=>$_POST['email'],'moblie'=>$_POST['telphone']),$where);
					$this->member_log("保存基本信息");
					$resume=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'");
					if($resume['name']==""||$resume['living']=="")
					{
						$this->MODEL('userinfo')->company_invtal($this->uid,$this->config['integral_userinfo'],true,"首次填写基本资料",true,2,'integral',25);
					}else{
						$this->obj->update_once("resume_expect",array("edu"=>$_POST['edu'],"exp"=>$_POST['exp'],"uname"=>$_POST['name'],"sex"=>$_POST['sex'],"birthday"=>$_POST['birthday']),$where);
					}
					$data['msg']='保存成功！';
				}else{
					$data['msg']='保存失败！';
				}
				if($_POST['eid']){
					$data['url']="index.php?c=modify&eid=".$_POST['eid'];
				}else{
					$data['url']="index.php?c=info";
				}
			}

			$this->yunset("layer",$data);
		}

		$resume=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'");
		$this->yunset("resume",$resume);
        $this->yunset($this->MODEL('cache')->GetCache(array('user')));
		$this->waptpl('info');
	}
    function addexpect_action(){
    	$CacheArr=$this->MODEL('cache')->GetCache(array('city','user','hy','job'));
        $this->yunset($CacheArr);
		if($_GET['eid']){
			$row=$this->obj->DB_select_once("resume_expect","`id`='".(int)$_GET['eid']."' and `uid`='".$this->uid."'");
			if($row['job_classid']){
				$job_classid=@explode(',',$row['job_classid']);
				$jobname=array();
				foreach($job_classid as $val){
					$jobname[]=$CacheArr['job_name'][$val];
				}
			}
			$this->yunset("jobname",@implode('+',$jobname));
			$this->yunset("row",$row);
		}
		$this->waptpl('addexpect');
	}
	function expect_action()
	{
		$eid=(int)$_POST['eid'];
		unset($_POST['submit']);
		unset($_POST['eid']);
		$where['id']=$eid;
		$where['uid']=$this->uid;
		$_POST['lastupdate']=time();
		$_POST['height_status']="0";
		if($eid=="")
		{
            $num=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."'");
			$_POST['uid']=$this->uid;
            $_POST['defaults']=$num<=0?1:0;
			$nid=$this->obj->insert_into("resume_expect",$_POST);
			if ($nid)
			{
				$num=$this->obj->DB_select_once("member_statis","`uid`='".$this->uid."'");
				if($num['resume_num']==0)
				{
					$this->obj->update_once('resume',array('def_job'=>$nid),array('uid'=>$this->uid));
				}
				$data['uid'] = $this->uid;
				$data['eid'] = $nid;
				$this->obj->insert_into("user_resume",$data);
				$this->obj->DB_update_all('member_statis',"`resume_num`=`resume_num`+1","`uid`='".$this->uid."'");
				$state_content = "发布了 <a href=\"".$this->config['sy_weburl']."/index.php?m=resume&id=$nid\" target=\"_blank\">新简历</a>。";
				$fdata['uid']	  = $this->uid;
				$fdata['content'] = $state_content;
				$fdata['ctime']   = time();
				$this->obj->insert_into("friend_state",$fdata);
				$this->member_log("发布了新简历");
			}
			$eid=$nid;
		}else{
			$nid=$this->obj->update_once("resume_expect",$_POST,$where);
			$this->member_log("更新了简历");
		}
		echo $nid;die;
	}
	function resume_action(){
		$this->rightinfo();
		$rows=$this->obj->DB_select_all("resume_expect","`uid`='".$this->uid."'","id,name,lastupdate,height_status,open,hits,defaults");
		$this->yunset("rows",$rows);
		$defjob=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'","def_job");
		$this->yunset("defjob",$defjob);
		$this->waptpl('resume');
	}
	function modify_action(){
		if($_POST['submit'])
		{
			if($_POST['name']==""){
				$data['msg']='简历名称不能为空！';
				$data['url']='index.php?c=modify&eid='.$_POST['eid'];
				$this->yunset("layer",$data);
			}else{
				$this->obj->DB_update_all("resume_expect","`name`='".$_POST['name']."'","`uid`='".$this->uid."' and `id`='".$_POST['eid']."'");
				$data['msg']='简历名称修改成功！';
				$data['url']='index.php?c=modify&eid='.$_POST['eid'];
				$this->member_log("修改简历名称");
			}
			$this->yunset("layer",$data);
		}
		$expect=$this->obj->DB_select_once("resume_expect","`uid`='".$this->uid."' and `id`='".$_GET['eid']."'");
		$this->yunset("expect",$expect);
		$resume=$this->obj->DB_select_once("user_resume","`eid`='".$_GET['eid']."'");
		$this->yunset("resume",$resume);
		$desc=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'","`description`");
		$this->yunset("description",$desc['description']);
		$this->rightinfo();
		$this->waptpl('modify');
	}
    function rinfo_action(){
		if(!in_array($_GET['type'],array('expect','cert','doc','edu','other','project','show','skill','tiny','training','work'))){
				unset($_GET['type']);
		}
		if($_GET['type']&&intval($_GET['id'])){
			$nid=$this->obj->DB_delete_all("resume_".$_GET['type'],"`eid`='".(int)$_GET['eid']."' and `id`='".(int)$_GET['id']."' and `uid`='".$this->uid."'");
			if($nid)
			{
				$url=$_GET['type'];
				$this->obj->DB_update_all("user_resume","`$url`=`$url`-1","`eid`='".(int)$_GET['eid']."' and `uid`='".$this->uid."'");
				$resume_row=$this->obj->DB_select_once("user_resume","`eid`='".(int)$_GET['eid']."'");
				$this->complete($resume_row);
				$data['msg']='删除成功！';
			}else{
				$data['msg']='删除失败！';
			}
            $data['url']="index.php?c=rinfo&eid=".(int)$_GET['eid']."&type=".$_GET['type'];
			$this->yunset("layer",$data);
		}
		$this->rightinfo();
		$this->yunset($this->MODEL('cache')->GetCache(array('city','user','hy','job')));
		$rows=$this->obj->DB_select_all("resume_".$_GET['type'],"`eid`='".(int)$_GET['eid']."' and `uid`='".$this->uid."'");
		$this->yunset("rows",$rows);
		$this->yunset("type",$_GET['type']);
		$this->yunset("eid",$_GET['eid']);
		$this->waptpl('rinfo');
	}
	function resumeset_action(){
		if($_GET['del']){
			$del=(int)$_GET['del'];
			$del_array=array("resume_cert","resume_edu","resume_other","resume_project","resume_skill","resume_training","resume_work","resume_doc","user_resume");
			if($this->obj->DB_delete_all("resume_expect","`id`='".$del."' and `uid`='".$this->uid."'")){
				foreach($del_array as $v){
					$this->obj->DB_delete_all($v,"`eid`='".$del."'' and `uid`='".$this->uid."'","");
				}
				$defid=$this->obj->DB_select_once("resume","`uid`='".$this->uid."' and `def_job`='".$del."'");
			    if(is_array($defid)){
					$row=$this->obj->DB_select_once("resume_expect","`uid`='".$this->uid."'");
					$this->obj->update_once('resume_expect',array('defaults'=>1),array('id'=>$row['id']));
					$this->obj->update_once('resume',array('def_job'=>$row['id']),array('uid'=>$this->uid));
			    }
				$allnum=$this->obj->DB_select_once("member_statis","`uid`='".$this->uid."'","resume_num");
				$num=$allnum['resume_num']-1;
				$num<0?$num=0:$num=$num;
				$this->obj->DB_update_all('member_statis',"`resume_num`='".$num."'","`uid`='".$this->uid."'");
				$this->member_log("删除简历");
				$this->waplayer_msg("删除成功！");
			}else{
				$this->waplayer_msg("删除失败！");
			}
		}else if($_GET['update']){
			$id=(int)$_GET['update'];
			$nid=$this->obj->update_once('resume_expect',array('lastupdate'=>time()),array('id'=>$id,'uid'=>$this->uid));
			$nid?$this->waplayer_msg("刷新成功！"):$this->waplayer_msg("刷新失败！");
		}else if($_GET['def']){
			$nid=$this->obj->DB_update_all("resume","`def_job`='".(int)$_GET['def']."'","`uid`='".$this->uid."'");
            $nid=$this->obj->DB_update_all("resume_expect","`defaults`=''","`uid`='".$this->uid."'");
            $nid=$this->obj->DB_update_all("resume_expect","`defaults`='1'","`uid`='".$this->uid."' and `id`='".$_GET['def']."'");
			$nid?$this->waplayer_msg("设置成功！"):$this->waplayer_msg("设置失败！");
		}else if($_GET['open']){
			if(!in_array($_GET['type'],array('expect','cert','doc','edu','other','project','show','skill','tiny','training','work'))){
				unset($_GET['type']);
			}
			$_GET['type']?$type='1':$type='0';
			$nid=$this->obj->DB_update_all("resume_expect","`open`='".$type."'","`uid`='".$this->uid."' and `id`='".(int)$_GET['open']."'");
            $nid=$this->obj->DB_update_all("resume_expect","`defaults`=''","`uid`='".$this->uid."'");
			$nid?$this->waplayer_msg("设置成功！"):$this->waplayer_msg("设置失败！");
		}
	}
	function loginout_action()
	{
		SetCookie("uid","",time() -86400, "/");
		SetCookie("username","",time() - 86400, "/");
		SetCookie("usertype","",time() -86400, "/");
		SetCookie("salt","",time() -86400, "/");
		SetCookie("shell","",time() -86400, "/");
		$this->wapheader('index.php');
	}
	function lookjobdel_action(){
		$this->rightinfo();
		if($_GET['id']){
			$nid=$this->obj->DB_update_all("look_job","`status`='1'","`id`='".$_GET['id']."' and `uid`='".$this->uid."'");
			if($nid){
				$this->member_log("删除职位浏览记录(ID:".$_GET['id'].")");
				$this->waplayer_msg('删除成功！');
			}else{
				$this->waplayer_msg('删除失败！');
			}
		}
	}
	function look_job_action(){
		$this->rightinfo();
		$urlarr=array("c"=>$_GET['c'],"page"=>"{{page}}");
		$pageurl=Url('wap',$urlarr,'member');
		$look=$this->get_page("look_job","`uid`='".$this->uid."' and `status`='0' order by `datetime` desc",$pageurl,"10");
		if(is_array($look))
		{
			include PLUS_PATH."/city.cache.php";
			include PLUS_PATH."/com.cache.php";
			foreach($look as $v){
				$jobid[]=$v['jobid'];
			}
			$job=$this->obj->DB_select_all("company_job","`id` in (".pylode(",",$jobid).")","`id`,`name`,`com_name`,`salary`,`provinceid`,`cityid`,`uid`,`edate`,`status`,`state`");

			foreach($look as $k=>$v)
			{
				foreach($job as $val)
				{
					if($v['jobid']==$val['id'])
					{
						if($val['edate']<time()){
							$look[$k]['jobstate']=2;
						}else if($val['status']=='1'||$val['state']!='1'){
							$look[$k]['jobstate']=3;
						}else{
							$look[$k]['jobstate']=1;
						}
						$look[$k]['jobname']=$val['name'];
						$look[$k]['com_id']=$val['uid'];
						$look[$k]['job_id']=$val['id'];
						$look[$k]['comname']=$val['com_name'];
						$look[$k]['salary']=$comclass_name[$val['salary']];
						$look[$k]['provinceid']=$city_name[$val['provinceid']];
						$look[$k]['cityid']=$city_name[$val['cityid']];
					}
				}
			}
		}
		$this->yunset("js_def",2);
		$this->yunset("look",$look);
		$this->waptpl('look_job');
	}
	function getYears($startYear=0,$endYear=0){
		$list=array();
		$month_list=array();
		if($endYear>0){
			if($startYear<=0){
				$startYear=	$endYear-150;
			}
			for($i=$endYear;$i>=$startYear;$i--){
				$list[]=$i;
			}
		}
		for($i=12;$i>=1;$i--){
			$month_list[]=$i;
		}
		$this->yunset("year_list",$list);
		$this->yunset("month_list",$month_list);
		return $list;
	}
}
?>