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
class expect_controller extends user{

	function index_action(){

		if($this->config['user_enforce_identitycert']=="1"){
			$row=$this->obj->DB_select_once("resume","`idcard_pic`<>'' and `uid`='".$this->uid."'");
			if($row['idcard_status']!="1"){
				$this->ACT_msg("index.php?c=binding","请先完成身份认证！");
			}
		}


		if($_POST['shell']==1){
			$resume=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'");
			if($resume['name']==""){
				echo 1;
			}die;
		}

		if(!$_GET['e']){
			$num=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."'");
			if($num>=$this->config['user_number']){
				$this->ACT_msg("index.php?c=resume","你的简历数已经超过系统设置的简历数了");
			}
		}
		include PLUS_PATH."/job.cache.php";
		include PLUS_PATH."/city.cache.php";
		$job_area = $this->city_info($job_index,$job_name);
		$this->yunset("job_area",$job_area);
		$this->industry_cache();

		if($_GET['e']){
			$eid=(int)$_GET['e'];
			$row=$this->obj->DB_select_once("resume_expect","id='".$eid."' AND `uid`='".$this->uid."'");
			if(!is_array($row) || empty($row)){
				$this->ACT_msg("index.php?c=resume","无效的简历！");
			}
			$job_classid=@explode(",",$row['job_classid']);
			if(is_array($job_classid)){
				foreach($job_classid as $key){
					$job_classname[]=$job_name[$key];
				}
				$this->yunset("job_classname",pylode(' ',$job_classname));
				$this->yunset("job_classname2",pylode(',',$job_classname));
			}
			$this->yunset("job_classid",$job_classid);

			$skill = $this->obj->DB_select_all("resume_skill","`eid`='".$eid."' AND `uid` = '".$this->uid."'");
			$this->yunset("skill",$skill);

			$work = $this->obj->DB_select_all("resume_work","`eid`='".$eid."' AND `uid` = '".$this->uid."'");
			$this->yunset("work",$work);

			$project = $this->obj->DB_select_all("resume_project","`eid`='".$eid."' AND `uid` = '".$this->uid."'");
			$this->yunset("project",$project);

			$edu = $this->obj->DB_select_all("resume_edu","`eid`='".$eid."' AND `uid` = '".$this->uid."'");
			$this->yunset("edu",$edu);

			$training = $this->obj->DB_select_all("resume_training","`eid`='".$eid."' AND `uid` = '".$this->uid."'");
			$this->yunset("training",$training);

			$cert = $this->obj->DB_select_all("resume_cert","`eid`='".$eid."' AND `uid` = '".$this->uid."'");
			$this->yunset("cert",$cert);

			$other = $this->obj->DB_select_all("resume_other","`eid`='".$eid."' AND `uid` = '".$this->uid."'");
			$this->yunset("other",$other);
			if(!trim($row['name'])){
				$DateStr=date('Y_m_d');
				$RowNum=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."' and `name` like '%$DateStr%'");
				$row['name']='我的简历'.(date('Y_m_d')).($RowNum?'_'.($RowNum+1):'');
			}
		}
		$resume=$this->obj->DB_select_once("resume","`uid`='".$this->uid."'");

        $ResumeList=$this->obj->DB_select_all("resume_expect","`uid`='".$this->uid."'","id,name,lastupdate,height_status,doc,tmpid,integrity,hits,statusbody,`topdate`");
		$this->yunset(array('resume'=>$resume,'row'=>$row,'ResumeList'=>$ResumeList));
		$this->public_action();
		$this->user_left();
		$this->yunset($this->MODEL('cache')->GetCache(array('job','city','hy','user')));
		$this->yunset("js_def",2);
		if($_GET['e'])
		{
			$this->user_tpl('expect');
		}else{
			$this->user_tpl('expect_add');
		}

	}
	function saveexpect_action(){
		if($_POST['submit']){
			$eid=(int)$_POST['eid'];
			unset($_POST['submit']);
			unset($_POST['eid']);
			unset($_POST['urlid']);
			$_POST['name'] = $this->stringfilter($_POST['name']);
			if(!$this->CheckRegUser($_POST['name'])){
				unset($_POST['name']);
			}
			$where['id']=$eid;
			$where['uid']=$this->uid;
			$_POST['lastupdate']=time();
			$_POST['height_status']="0";
			if(!preg_match("/^[0-9,]+$/",$_POST['classid'])){
				unset($_POST['classid']);
			}
			if($eid==""){
				$num=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."'");
				if($num>=$this->config['user_number']){
					echo 1;die;
				}
				$_POST['uid']=$this->uid;
				$_POST['ctime']=time();
                $_POST['defaults']=$num<=0?1:0;
				$nid=$this->obj->insert_into("resume_expect",$_POST);
				if ($nid){
					if($num==0){
						$this->obj->update_once('resume',array('def_job'=>$nid),array('uid'=>$this->uid));
					}
					$data['uid'] = $this->uid;
					$data['eid'] = $nid;
					$this->obj->insert_into("user_resume",$data);
					$this->obj->DB_update_all('member_statis',"`resume_num`=`resume_num`+1","`uid`='".$this->uid."'");
					$state_content = "发布了 <a href=\"".Url('resume',array("c"=>'show',"id"=>$nid))."\" target=\"_blank\">新简历</a>。";

					$fdata['uid']	  = $this->uid;
					$fdata['content'] = $state_content;
					$fdata['ctime']   = time();
					$fdata['type']   = 2;
					$this->obj->insert_into("friend_state",$fdata);
					$this->obj->member_log("创建一份简历",2,1);
					$this->get_integral_action($this->uid,"integral_add_resume","发布简历");
					$this->warning("3");
				}
				$eid=$nid;
			}else{
				$nid=$this->obj->update_once("resume_expect",$_POST,$where);
				$this->obj->member_log("修改简历",2,2);
			}
			$this->obj->update_once('user_resume',array('expect'=>1),array('eid'=>$eid,'uid'=>$this->uid));
			if($nid){
				$resume_row=$this->obj->DB_select_once("user_resume","`eid`='".$eid."'");
				$numresume=$this->complete($resume_row);
				$resume=$this->obj->DB_select_once("resume_expect","`id`='".$eid."'");
				$resume['numresume']=$numresume;
				include PLUS_PATH."/user.cache.php";
				include PLUS_PATH."/job.cache.php";
				include PLUS_PATH."/city.cache.php";
				include PLUS_PATH."/industry.cache.php";
				$resume['report']=$userclass_name[$resume['report']];
				$resume['hy']=$industry_name[$resume['hy']];
				$resume['city']=$city_name[$resume['provinceid']]." ".$city_name[$resume['cityid']]." ".$city_name[$resume['three_cityid']];
				$resume['salary']=$userclass_name[$resume['salary']];
				$resume['type']=$userclass_name[$resume['type']];
				$resume['jobstatus']=$userclass_name[$resume['jobstatus']];
				if($resume['job_classid']!=""){
					$job_classid=@explode(",",$resume['job_classid']);
					foreach($job_classid as $v){
						$job_classname[]=$job_name[$v];
					}
					$resume['job_classname']=pylode(" ",$job_classname);
				}
				$resume['three_cityid']=$city_name[$resume['three_cityid']];
				if(is_array($resume)){
					foreach($resume as $k=>$v){
						$arr[$k]=iconv("gbk","utf-8",$v);
					}
				}
				echo json_encode($arr);die;
			}else{
				echo 0;die;
			}
		}
	}

	function add_action(){
		if($_POST['submit']){
			$num=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."'");
			if($num>=$this->config['user_number']){
				$this->ACT_layer_msg("简历数量超限！",2);
			}
			if($_POST['name']==""){
				$this->ACT_layer_msg("请填写简历名称！",2);
			}
			if($_POST['hy']==""){
				$this->ACT_layer_msg("请选择从事行业！",2);
			}
			if($_POST['job_class']==""){
				$this->ACT_layer_msg("请选择期望职位！",2);
			}
			if($_POST['salary']==""){
				$this->ACT_layer_msg("请选择期望薪资！",2);
			}
			if($_POST['provinceid']==""){
				$this->ACT_layer_msg("请选择期望城市！",2);
			}
			if($_POST['report']==""){
				$this->ACT_layer_msg("请选择到岗时间！",2);
			}
			if($_POST['type']==""){
				$this->ACT_layer_msg("请选择工作性质！",2);
			}
			if($_POST['jobstatus']==""){
				$this->ACT_layer_msg("请选择求职状态！",2);
			}
			$_POST=$this->post_trim($_POST);
			if($_POST['uname']==""){
				$this->ACT_layer_msg("请填写真实姓名！",2);
			}
			if($_POST['sex']==""){
				$this->ACT_layer_msg("请选择性别！",2);
			}
			if($_POST['birthday']==""){
				$this->ACT_layer_msg("请选择出生年月！",2);
			}
			if($_POST['edu']==""){
				$this->ACT_layer_msg("请选择最高学历！",2);
			}
			if($_POST['exp']==""){
				$this->ACT_layer_msg("请选择工作经验！",2);
			}
			if($_POST['telphone']==""){
				$this->ACT_layer_msg("请填写联系电话！",2);
			}else{
				$is_exist_mobile=$this->obj->DB_select_num("member","`uid`<>'".$this->uid."' and `moblie`='".$_POST['telphone']."'","`uid`");
				if($is_exist_mobile){
					$this->ACT_layer_msg("手机已存在！",2);
				}
			}

			if($_POST['email']==""){
				$this->ACT_layer_msg("请填写联系邮箱！",2);
			}else{
				$is_exist_email=$this->obj->DB_select_num("member","`uid`<>'".$this->uid."' and `email`='".$_POST['email']."'","`uid`");
				if($is_exist_email){
					$this->ACT_layer_msg("邮箱已存在！",2);
				}
			}

			if($_POST['living']==""){
				$this->ACT_layer_msg("现居住地不能为空！",2);
			}

			unset($_POST['submit']);
			delfiledir("../data/upload/tel/".$this->uid);
			$where['uid']=$this->uid;
			$infoDate = array(
				"name"		=>	$_POST['uname'],
				"sex"		=>	$_POST['sex'],
				"birthday"	=>	$_POST['birthday'],
				"edu"		=>	$_POST['edu'],
				"exp"		=>	$_POST['exp'],
				"telphone"	=>	$_POST['telphone'],
				"email"		=>	$_POST['email'],
				"living"	=>	$_POST['living']
			);
			$this->obj->update_once('resume',$infoDate,$where);
			$this->obj->update_once('member',array('email'=>$_POST['email'],'moblie'=>$_POST['telphone']),$where);

			unset($where);
			$where['uid']=$this->uid;
			$_POST['height_status']="0";
			if(!preg_match("/^[0-9,]+$/",$_POST['classid'])){
				unset($_POST['classid']);
			}

			$_POST['uid']=$this->uid;
			$_POST['ctime']=time();
			$_POST['defaults']=$num<=0?1:0;

			$expectDate = array(
				"lastupdate"	=>	time(),
				"height_status"	=>	0,
				"uid"			=>	$this->uid,
				"defaults"		=>	$num<=0?1:0,
				"ctime"			=>	time(),
				"name"			=>	$_POST['name'],
				"hy"			=>	$_POST['hy'],
				"job_classid"	=>	$_POST['job_class'],
				"salary"		=>	$_POST['salary'],
				"provinceid"	=>	$_POST['provinceid'],
				"cityid"		=>	$_POST['citysid'],
				"three_cityid"	=>	$_POST['three_cityid'],
				"type"			=>	$_POST['type'],
				"report"		=>	$_POST['report'],
				"jobstatus"		=>	$_POST['jobstatus'],
				"integrity"		=>	55
			);
			$nid=$this->obj->insert_into("resume_expect",$expectDate);
			if ($nid){
				if($num==0){
					$this->obj->update_once('resume',array('def_job'=>$nid),array('uid'=>$this->uid));
				}
				$data['uid'] = $this->uid;
				$data['eid'] = $nid;
				$data['expect'] ='1';
				$this->obj->insert_into("user_resume",$data);
				$this->obj->DB_update_all('member_statis',"`resume_num`=`resume_num`+1","`uid`='".$this->uid."'");
				$state_content = "发布了 <a href=\"".Url("resume",array("c"=>"show","id"=>$nid))."\" target=\"_blank\">新简历</a>。";
				$fdata['uid']	  = $this->uid;
				$fdata['content'] = $state_content;
				$fdata['ctime']   = time();
				$fdata['type']   = 2;
				$this->obj->insert_into("friend_state",$fdata);
				$this->obj->member_log("创建一份简历",2,1);
				$this->get_integral_action($this->uid,"integral_add_resume","发布简历");
				$this->warning("3");
			}
			$resume = $this->obj->DB_select_once("resume","`uid`='".$this->uid."'","`name`,`edu`,`exp`,`sex`,`birthday`,`idcard_status`,`status`,`r_status`");
			$this->obj->update_once("resume_expect",array(
				"edu"=>$resume['edu'],
				"exp"=>$resume['exp'],
				"uname"=>$resume['name'],
				"sex"=>$resume['sex'],
				"birthday"=>$resume['birthday'],
				"idcard_status"=>$resume['idcard_status'],
				"status"=>$resume['status'],
				"r_status"=>$resume['r_status'],
				"photo"=>$resume['photo']
				),$where);
			$this->ACT_layer_msg("简历创建成功，继续完善！",9,'index.php?c=expect&act=success&e='.$nid);
		}

	}
	function success_action(){

		if($_GET['e'])
		{
			$this->yunset('id',$_GET['e']);
			$this->user_tpl('expect_success');
		}else{

			header("Location:index.php?c=expect");
		}

	}
    function save_resume_name_action(){
        if(!is_numeric($_POST['eid'])){
            $this->ACT_msg("","简历编号格式不正确！");die;
        }
        $IsSuccess=$this->obj->update_once('resume_expect',array('name'=>$_POST['name']),array('uid'=>$this->uid,'id'=>$_POST['eid']));
        if($IsSuccess){
            $this->ACT_layer_msg("修改成功！",9,$_SERVER['HTTP_REFERER'],2,0);die;
        }else{
            $this->ACT_layer_msg("修改失败！",9,$_SERVER['HTTP_REFERER'],2,0);die;
        }
    }
	function savedescription_action(){

		if(!is_numeric($_POST['eid'])){
            $this->ACT_msg("","简历编号格式不正确！");die;
        }
        $IsSuccess=$this->obj->update_once('resume',array('description'=>yun_iconv('utf-8','gbk',$_POST['description'])),array('uid'=>$this->uid));
        if($IsSuccess){
            echo 1;die;
            $this->ACT_layer_msg("修改成功！",9,$_SERVER['HTTP_REFERER'],2,0);die;
        }else{
            echo 0;die;
            $this->ACT_layer_msg("修改失败！",9,$_SERVER['HTTP_REFERER'],2,0);die;
        }
    }
	function work_action(){
		$this->resume("resume_work","work","expect","填写工作经验");
		$this->public_action();
	}
	function edu_action(){
		$this->resume("resume_edu","edu","training","填写教育经历");
		$this->public_action();
		$this->user_tpl('edu');
	}
	function training_action(){
		$this->resume("resume_training","training","cert","填写培训经历");
		$this->public_action();
		$this->user_tpl('training');
	}
	function project_action(){
		$this->resume("resume_project","project","edu","填写项目经历");
		$this->public_action();
		$this->user_tpl('project');
	}
	function skill_action(){
		$this->resume("resume_skill","skill","expect","填写专业技能");
		$this->public_action();
	}
	function cert_action(){
		$this->resume("resume_cert","cert","other","填写证书信息");
		$this->public_action();
		$this->user_tpl('cert');
	}
	function other_action(){
		$this->resume("resume_other","other","resume","返回简历管理");
		$this->public_action();
		$this->user_tpl('other');
	}
}
?>