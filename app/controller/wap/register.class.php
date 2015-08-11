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
class register_controller extends common{
	function index_action(){
		$this->get_moblie();
		if($this->uid || $this->username){
			echo "<script>location.href='member/index.php';</script>";
		}
		if($_POST['submit']){


			$usertype=$_POST['usertype']?$_POST['usertype']:1;
            $_POST['username']=yun_iconv('utf-8','gbk',$_POST['username']);
			if(!$this->CheckRegUser($_POST['username']) && !$this->CheckRegEmail($_POST['username'])){
                $this->layer_msg('无效的用户名！',9,0,'');
			}
			if(!$this->CheckRegEmail($_POST['email'])){
                $this->layer_msg('邮箱格式不正确！',9,0,'');
			}
            $UserinfoM=$this->MODEL('userinfo');
			$member=$UserinfoM->GetMemberOne(array('username'=>$_POST['username']," or `email`='".$_POST['email']."'"));
			if(is_array($member)){
				if($member['username']==$_POST['username']){
                    $this->layer_msg('用户名已存在，请重新输入！',9,0,'');
				}elseif($member['email']==$_POST['email']){
                    $this->layer_msg('邮箱已存在，请重新输入！',9,0,'');
				}
			}else{
				$regname=@explode(",",$this->config['sy_regname']);
				if(in_array($_POST['username'],$regname)){
                    $this->layer_msg('用户名已存在，请重新输入！',9,0,'');
				}
			}
			if($usertype=='1'){
				$status = 1;
			}elseif($usertype=='2'){
				$status = $this->config['com_status'];
			}
			if($this->config['sy_uc_type']=="uc_center"){
				$this->uc_open();
				$uid=uc_user_register($_POST['username'],$_POST['password'],$_POST['email']);
				if($uid<=0){
                    $this->layer_msg('该用户或邮箱已存在！',9,0,'');
				}else{
					list($uid,$username,$password,$email,$salt)=uc_user_login($_POST['username'],$_POST['password']);
					$pass = md5(md5($_POST['password']).$salt);
					$ucsynlogin=uc_user_synlogin($uid);
				}
			}elseif($this->config['sy_pw_type']=="pw_center"){
				include(APP_PATH."/api/pw_api/pw_client_class_phpapp.php");
				$username=$username;
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

            $idata=array('username'=>$_POST['username'],'password'=>$pass,'email'=>$_POST['email'],'usertype'=>$usertype,'status'=>$status,'salt'=>$salt,'reg_date'=>time(),'login_date'=>time());
			$userid=$UserinfoM->AddMember($idata);
			if($userid){
				if($_COOKIE['wxid']){
					$UserinfoM->UpdateMember(array('wxid'=>''),array('wxid'=>$_COOKIE['wxid']));
					$UserinfoM->UpdateMember(array('wxid'=>$_COOKIE['wxid']),array('uid'=>$userid));
					setcookie("wxid",'',time() - 86400, "/");
				}
				if($_COOKIE['unionid']){
					$UserinfoM->UpdateMember(array('unionid'=>''),array('unionid'=>$_COOKIE['unionid']));
					$UserinfoM->UpdateMember(array('unionid'=>$_COOKIE['unionid']),array('uid'=>$userid));
					setcookie("unionid",'',time() - 86400, "/");
				}
				if($this->config[sy_pw_type]=="pw_center"){
					$UserinfoM->UpdateMember(array('pwuid'=>$pwuid),array('uid'=>$userid));
				}

                $UserinfoM->RegisterMember($_POST,array('uid'=>$userid,'usertype'=>$usertype));
				if($this->config['integral_reg']!="")
				{
					$UserinfoM->company_invtal($userid,$this->config['integral_reg'],true,"注册",true,2,'integral','26');
				}
				$this->add_cookie($userid,$_POST['username'],$salt,$_POST['email'],$pass,$usertype);
				$this->layer_msg('恭喜您，已成功注册会员！',9,0,'member/index.php?c=addresume');
			}
		}
		if($_GET['usertype']=="2"){
			$this->yunset("headertitle","会员注册");
		}else{
			$this->yunset("headertitle","会员注册");
		}
		$this->seo("register");
		$this->yuntpl(array('wap/register'));
	}
}
?>