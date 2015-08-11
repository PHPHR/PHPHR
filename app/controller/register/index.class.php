<?php

/**
 * Class index_controller
 */
class index_controller extends common{
//	function index_action()
//	{
//		if($_COOKIE['uid']!=""&&$_COOKIE['username']!=""){
//			$this->ACT_msg($this->config['sy_weburl'], "您已经登录了！");
//		}
//		if($_GET['uid'])
//		{
//			setcookie("regcode",$_GET['uid'],time()+3600,"/");
//		}else{
//			setcookie("regcode",$_GET['uid'],time()-3600,"/");
//		}
//		$this->seo("register");
//		if($_GET['usertype']=="2"){
//			$this->yun_tpl(array('company'));
//		}else{
//			$this->yun_tpl(array('user'));
//		}
//	}

    /**
     *  注册引导
     */
    public function index_action()
    {
        $this->seo("register");
        $this->yun_tpl(['reg']);
    }

    /**
     * 注册页
     */
    public function reguser_action()
    {
        //注册意向
        if(!empty(intval($_GET['t']))){
            setcookie("regtype",$_GET['t'],time()+604800,"/",COOKIE_DOMAIN);
        }
        $this->seo("register");
        $this->yun_tpl(['reguser']);
    }

    /**
     * 注册保存
     */
    public function savereg_action()
    {
        $userName = trim($_POST['username']);
        $password = trim($_POST['password']);
        $vcode = trim($_POST['vcode']);

        //验证码
        if(md5($vcode)!=$_SESSION['authcode']) {
            echo json_encode(['msg'=>'code_error']);die;
        }

        //用户名验证
        if(is_numeric($userName)){
            if(!preg_match("/^1[3,5,8,7]{1}[0-9]{9}$/",$userName)){ //手机号码验证
                echo json_encode(['msg'=>'username_error']);die;
            }
        }else{
            if(!preg_match("/^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/",$userName)){   //邮箱验证
                echo json_encode(['msg'=>'username_error']);die;
            }
        }

        //检查用户是否注册
        $Member=$this->MODEL("userinfo");
        $nid = $Member->GetMemberNum(array("username"=>$userName));
        if($nid){
            echo json_encode(['msg'=>'user_exist']);die;
        }
        $salt=substr(uniqid(),-6);
        if($Member->AddMember([
            'username'=>$userName,
            'password'=>md5(md5($password).$salt),
            'salt'=>$salt,
            'usertype'=>0,
            'reg_time'=>time(),
        ])){
            $_SESSION['is_login']=1;
            $_SESSION['username']=$userName;
            echo json_encode(['msg'=>'succ']);
        }
    }

    /**
     *  注册成功
     */
    public function regok_action()
    {
        $this->seo("register");
        $this->yun_tpl(['regok']);
    }

    /**
     *  个人基本信息
     */
    public function person_action()
    {
        $this->seo("");
        $this->yun_tpl(["person"]);
    }

	function ok_action()
	{
		if($_GET['type']==1)
		{
			$seo=$this->config['sy_webname']."- 注册成功";
		}elseif($_GET['type']==2){
			$seo=$this->config['sy_webname']."- 帐号被锁定";
		}elseif($_GET['type']==3){
			$seo=$this->config['sy_webname']."- 审核未通过";
		}elseif($_GET['type']==4){
			$seo=$this->config['sy_webname']."- 邮件认证成功";
		}else{
			header("location:".$this->config['sy_weburl']);
		}
		$this->yunset("title",$seo);
		$this->yunset("keywords",$seo);
		$this->yunset("description",$seo);

		$this->yun_tpl(array('ok'));
	}
	function ajax_reg_action(){
		$post = array_keys($_POST);
		$key_name = $post[0];
		if(!in_array($key_name,array('username','email')))
		{
			exit();
		}
		$Member=$this->MODEL("userinfo");
		if($key_name=="username"){
			$username=yun_iconv("utf-8","gbk",$_POST['username']);
			if(!$this->CheckRegUser($username) && !$this->CheckRegEmail($username))
			{
				echo 2;die;
			}
			if($this->config['sy_uc_type']=="uc_center"){
				$this->uc_open();
				$user = uc_get_user($username);
			}else{
				$user = $Member->GetMemberNum(array("username"=>$username));
			}
			if($this->config['sy_regname']!=""){
				$regname=@explode(",",$this->config['sy_regname']);
				if(in_array($username,$regname)){
					echo 3;die;
				}
			}
		}elseif($key_name=="email"){
			if(!$this->CheckRegEmail($_POST['email'])){
				echo 2;die;
			}
			$user = $Member->GetMemberNum(array("`email`='".$_POST['email']."' or `username`='".$_POST['email']."'"));
		}
		if($user){echo 1;}else{echo 0;}
	}
	function regmoblie_action(){
		if($_POST['moblie']){
			$Member=$this->MODEL("userinfo");
			$num = $Member->GetMemberNum(array("moblie='".$_POST['moblie']."' or `username`='".$_POST['moblie']."'"));
			echo $num;die;
		}
	}
	function errjson($msg,$status='8'){
		$arr['status']=$status;
		$arr['msg']=yun_iconv("gbk","utf-8",$msg);
		echo json_encode($arr);die;
	}
	function regsave_action(){
		$_POST=$this->post_trim($_POST);
		$usertype=intval($_POST['usertype']);
		$_POST['username']=yun_iconv("utf-8","gbk",$_POST['username']);
		$_POST['unit_name']=yun_iconv("utf-8","gbk",$_POST['unit_name']);
		$_POST['address']=yun_iconv("utf-8","gbk",$_POST['address']);
		$_POST['linkman']=yun_iconv("utf-8","gbk",$_POST['linkman']);
		$_POST['name']=yun_iconv("utf-8","gbk",$_POST['name']);

		if($_COOKIE['uid']!="" && $_COOKIE['username']!="")
		{
			$this->errjson('您已经登录了！');
		}
		if(strpos($this->config['code_web'],'注册会员')!==false)
		{
			session_start();
			if(md5($_POST['authcode'])!=$_SESSION['authcode'])
			{
				$this->errjson('验证码错误！');
			}
		}
		if(!$this->CheckRegUser($_POST['username']) && !$this->CheckRegEmail($_POST['username']))
		{
			$this->errjson('用户名包含特殊字符！');
		}

		$Member=$this->MODEL("userinfo");

		if($_POST['codeid']=='1')
		{
			if($this->config['reg_username'] =='1' && $usertype=='1')
			{
				if(!$this->CheckRegUser($_POST['name']) || $_POST['name']=="")
				{
					$this->errjson('真实姓名格式不规范');
				}
			}
			if(($this->config['reg_usertel']=='1' && $usertype=='1') || ($this->config['reg_comtel']=='1' && $usertype=='2'))
			{
				if(!preg_match("/1[34578]{1}\d{9}$/",$_POST['moblie'])){
					$this->errjson('手机格式错误！');
				}else{
					$moblieNum = $Member->GetMemberNum(array("moblie"=>$_POST['moblie']));
					if($moblieNum>0)
					{
						$this->errjson('手机已存在！');
					}
				}
			}
			if(($this->config['reg_useremail']=='1' && $usertype=='1') || ($this->config['reg_comemail']=='1' && $usertype=='2'))
			{
				if(!$this->CheckRegEmail($_POST['email']) || $_POST['email']=="")
				{
					$this->errjson('Email格式不规范！');
				}
			}
			if($usertype=='2')
			{
				if($this->config['reg_comname'] =='1')
				{
					if(!$this->CheckRegUser($_POST['unit_name']) || $_POST['unit_name']=="")
					{
						$this->errjson('请正确填写企业名称！');
					}
				}
				if($this->config['reg_comaddress'] =='1')
				{
					if(!$this->CheckRegUser($_POST['address']) || $_POST['address']=="")
					{
						$this->errjson('请正确填写企业地址！');
					}
				}
				if($this->config['reg_comlink'] =='1')
				{
					if(!$this->CheckRegUser($_POST['linkman']) || $_POST['linkman']=="")
					{
						$this->errjson('请正确填写企业联系人');
					}
				}

			}
		}elseif($_POST['codeid']=='2'){
			if(!preg_match("/1[34578]{1}\d{9}$/",$_POST['moblie']))
			{
				$this->errjson('手机格式错误！');
			}
			if($this->config['sy_msg_regcode']=="1")
			{
				if($_POST['moblie_code'])
				{
					$regCertMobile = $Member->GetCompanyCert(array("type"=>'2',"check"=>$_POST['moblie']));
				}
				if($regCertMobile['check2']!=$_POST['moblie_code'] || $regCertMobile['check2']=='')
				{
					$this->errjson('短信验证码错误！');
				}
			}
			$_POST['username'] =  $_POST['moblie'];

		}elseif($_POST['codeid']=='3'){

			if(!$this->CheckRegEmail($_POST['email']) || $_POST['email']==""){

				$this->errjson('Email格式不规范！');
			}
			$_POST['username'] =  $_POST['email'];
		}

		if($_POST['username']!=""){
			$nid = $Member->GetMemberNum(array("username"=>$_POST['username']));
			if($nid){
				$this->errjson('账户名已存在！');
			}else{
				if($_POST['usertype']=='1'){
					$satus = 1;
				}elseif($_POST['usertype']=='2'){
					$satus = $this->config['com_status'];
				}
				if($this->config['sy_uc_type']=="uc_center"){
					$this->uc_open();
					$uid=uc_user_register($_POST['username'],$_POST['password'],$_POST['email']);
					if($uid<=0){
						$this->errjson('该邮箱已存在！');
					}else{
						list($uid,$username,$password,$email,$salt)=uc_user_login($_POST['username'],$_POST['password']);
						$pass = md5(md5($_POST['password']).$salt);
						$ucsynlogin=uc_user_synlogin($uid);
					}
				}elseif($this->config['sy_pw_type']=="pw_center"){
					include(APP_PATH."/api/pw_api/pw_client_class_phpapp.php");
					$password=$_POST['password'];
					$email=$_POST['email'];
					$pw=new PwClientAPI($username,$password,$email);
					$pwuid=$pw->register();
					$salt = substr(uniqid(rand()), -6);
					$pass = md5(md5($password).$salt);
				}else{
					$salt = substr(uniqid(rand()), -6);
					$pass = md5(md5($_POST['password']).$salt);
				}
				$ip=fun_ip_get();
				$data['username']=$_POST['username'];
				$data['password']=$pass;
				$data['usertype']=$_POST['usertype'];
				$data['email']=$_POST['email'];
				$data['moblie']=$_POST['moblie'];
				$data['status']=$satus;
				$data['salt']=$salt;
				$data['reg_date']=time();
				$data['reg_ip']=$ip;
				$data['qqid']=$_SESSION['qq']['openid'];
				$data['sinaid']=$_SESSION['sina']['openid'];
				$data['wxid']=$_SESSION['wx']['openid'];
				$data['regcode']=(int)$_COOKIE['regcode'];
				$userid=$Member->AddMember($data);
				if(!$userid){
					$user_id = $Member->GetMemberOne(array("username"=>$_POST['username'],"field"=>"uid"));
					$userid = $user_id['uid'];
				}
				if($userid){

					$this->unset_cookie();
					if($this->config['sy_pw_type']=="pw_center"){
						$Member->UpdateMember(array("pwuid"=>$pwuid),array("uid"=>$userid));
					}
					if($_POST['usertype']=="1"){
						$table = "member_statis";
						$table2 = "resume";
						$data1=array("uid"=>$userid);
						$data2=array("uid"=>$userid,"email"=>$_POST['email'],"telphone"=>$_POST['moblie'],"name"=>$_POST['name']);
					}elseif($_POST['usertype']=="2"){
						$table = "company_statis";
						$table2 = "company";
						$data1=$Member->FetchRatingInfo(array("uid"=>$userid));
						$data2['uid']=$userid;
						$data2['linkmail']=$_POST['email'];
						$data2['name']=$_POST['unit_name'];
						$data2['linktel']=$_POST['moblie'];
						$data2['address']=$_POST['address'];
						$data2['linkman']=$_POST['linkman'];
						if($this->config['com_status']==0){
							$data2['r_status']=2;
						}
					}
					if($_POST['codeid']=='2' && $this->config['sy_msg_regcode']=="1")
					{
						$Member->UpdateMember(array("moblie"=>''),array("moblie"=>trim($_POST['moblie'])));
						if($usertype == '1'){
							$Member->UpdateResume(array("telphone"=>"","moblie_status"=>"0"),array("telphone"=>$_POST['moblie']));
							$data2['moblie_status']="1";
						}elseif($usertype == '2'){
							$Member->UpdateCompany(array("linktel"=>"","moblie_status"=>"0"),array("linktel"=>$_POST['moblie']));
							$data2['moblie_status']="1";
						}
					}
					$Member->InsertReg($table,$data1);
					$Member->InsertReg($table2,$data2);
					$Friend=$this->MODEL("friend");
					$Friend->SaveFriendInfo(array("uid"=>$userid,"nickname"=>$_POST['username'],"usertype"=>$_POST['usertype']));
					if($_COOKIE['regcode']!="")
					{
						if($this->config['integral_invite_reg_type']=="1")
						{
							$auto=true;
						}else{
							$auto=false;
						}
						$Member->company_invtal((int)$_COOKIE['regcode'],$this->config['integral_invite_reg'],$auto,"邀请注册",true,2,'integral',23);
					}
					if($this->config['integral_reg']>0)
					{
						$Member->company_invtal($userid,$this->config['integral_reg'],true,"注册赠送",true,2,'integral',23);
					}


					if($_POST['usertype']=="1"){
						if($this->config['user_status']=="1"&&$_POST['email']){
							$randstr=rand(10000000,99999999);
							$base=base64_encode($userid."|".$randstr."|".$this->config['coding']);
							$data_cert['uid']=$userid;
							$data_cert['type']="cert";
							$data_cert['email']=$_POST['email'];
							$data_cert['url']="<a href='".$this->config['sy_weburl']."/index.php?m=qqconnect&c=mcert&id=".$base."'>点击认证</a>";
							$data_cert['date']=date("Y-m-d");
							if($this->config['sy_smtpserver']!="" && $this->config['sy_smtpemail']!="" && $this->config['sy_smtpuser']!=""){
								$this->send_msg_email($data_cert);
								$this->errjson('帐号激活邮件已发送到您邮箱，请先激活！',7);
							}else{
								$this->errjson('还没有配置邮箱，请联系管理员！');
							}
						}else{
							$Member->UpdateMember(array("login_date"=>time()),array("uid"=>$userid));
							$this->add_cookie($userid,$_POST['username'],$salt,$_POST['email'],$pass,$usertype);
							$_POST['uid']=$userid;
							$this->regemail($_POST);
							$this->errjson('',1);
						}
					}elseif($usertype=="2"){
						$_POST['uid']=$userid;
						$this->regemail($_POST);
						if($this->config['com_status']!="1"){
							$this->errjson('注册成功，请等待管理员审核！',7);
						}else{
							$Member->UpdateMember(array("login_date"=>time()),array("uid"=>$userid));
							$this->add_cookie($userid,$_POST['username'],$salt,$_POST['email'],$pass,$usertype);
							$this->errjson('',1);
						}
					}
				}else{
					$this->errjson('注册失败！',8);
				}
			}
		}else if($_POST['username']==''){
			$this->errjson('用户名不能为空！',8);
		}
	}
	function regemail($post){
		if($this->config['sy_smtpserver']!="" && $this->config['sy_smtpemail']!="" && $this->config['sy_smtpuser']!=""){
			$this->send_msg_email(array("username"=>$post['username'],"password"=>$post['password'],"email"=>$post['email'],"type"=>"reg",'uid'=>$post['uid']));
		}
		if($this->config["sy_msguser"]!="" && $this->config["sy_msgpw"]!="" && $this->config["sy_msgkey"]!=""){
			$this->send_msg_email(array("username"=>$post['username'],"password"=>$post['password'],"moblie"=>$post['moblie'],"type"=>"reg",'uid'=>$post['uid']));
		}
	}
}
?>