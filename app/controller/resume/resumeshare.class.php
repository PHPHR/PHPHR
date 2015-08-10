<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class resumeshare_controller extends resume_controller{
	function index_action(){
		if($_POST){
			if($_POST['femail']=="" || $_POST['myemail']=="" || $_POST['authcode']==""){
				echo "请完整填写信息！";die;
			}
			session_start();
			if(md5($_POST['authcode'])!=$_SESSION['authcode']){
				unset($_SESSION['authcode']);echo "验证码不正确！";die;
			}
			if($_COOKIE["sendresume"]==$_POST['id']){
				echo "请不要频繁发送邮件！同一简历发送间隔为两分钟！";die;
			}
			if($this->config["sy_smtpserver"]=="" || $this->config["sy_smtpemail"]=="" ||	$this->config["sy_smtpuser"]==""){
				echo "网站邮件服务器不可用!";die;
			}
			if($this->CheckRegEmail(trim($_POST['femail']))==false){echo "邮箱格式错误！";die;}
			$contents=file_get_contents($this->config[sy_weburl]."/resume/index.php?c=sendresume&id=".$_POST['id']);
 			$smtp = $this->email_set();
			$smtpusermail =$this->config['sy_smtpemail'];
			$myemail = $this->stringfilter($_POST['myemail']);
			$sendid = $smtp->sendmail($_POST['femail'],$smtpusermail,"您的好友".$myemail."向您推荐了简历！",$contents,"HTML","","","",$myemail);
			if($sendid){
				echo 1;
			}else{
				echo "邮件发送错误 原因：1邮箱不可用 2网站关闭邮件服务";die;
			}
			SetCookie("sendresume",$_POST['id'],time() + 120, "/");
			die;
		}
		if($_GET['id']){
			$M=$this->MODEL('resume');
			$id=(int)$_GET['id'];
			$user=$M->resume_select($id);
			$this->yunset("Info",$user);
			$data['resume_username']=$user['username_n'];
			$data['resume_city']=$user['city_one'].",".$user['city_two'];
			$data['resume_job']=$user['hy'];
			$this->data=$data;
		}

		$this->seo("resume_share");
		$this->yun_tpl(array('resume_share'));
    }
}
?>