<?php
/* *
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
*/
class login_controller extends common{
	function index_action(){


		if(preg_match("/^[a-zA-Z0-9_-]+$/",$_GET['wxid']))
		{
		
			setcookie("wxid",$_GET['wxid'],time() + 86400, "/");
		}
		if(preg_match("/^[a-zA-Z0-9_-]+$/",$_GET['unionid']))
		{
			setcookie("unionid",$_GET['unionid'],time() + 86400, "/");
		}
	
		$this->get_moblie();
		if($this->uid || $this->username){
			if($_GET['bind']=='1'){
				$this->unset_cookie();
				$data['msg']='重新绑定您的求职账户！';
			}elseif($_GET['wxid']){

				$this->unset_cookie();
			}else{
				$this->wapheader('member/index.php');
			}
		}
		if($_POST['submit']){
            $UserinfoM=$this->MODEL('userinfo');
			if($_POST['wxid']){
				$wxparse = '&wxid='.$_POST['wxid'];
			}
			$username = yun_iconv("utf-8","gbk",$_POST['username']);

			if(!$this->CheckRegUser($username)){
				$data['msg']='无效的用户名！';
				$this->layer_msg($data['msg'],9,0,'',2);
			}
			if($username!=''){
				$userinfo = $UserinfoM->GetMemberOne(array('username'=>$username),array('field'=>"username,usertype,password,uid,salt"));
				if(!is_array($userinfo)){
					$data['msg']='用户不存在！';
					$this->layer_msg($data['msg'],9,0,'',2);
				}
				if($userinfo['usertype'] =='3' ){
					$data['msg']='手机访问暂只支持求职与招聘用户！';
					$this->layer_msg($data['msg'],9,0,'',2);
				}
				$pass = md5(md5($_POST['password']).$userinfo['salt']);
				
				if($pass!=$userinfo['password']){
					$data['msg']='密码不正确！';
				}else{
					
					if($_COOKIE['wxid']){
						$UserinfoM->UpdateMember(array('wxid'=>'','unionid'=>'','wxopenid'=>''),array('wxid'=>$_COOKIE['wxid']));
						$UserinfoM->UpdateMember(array('wxid'=>$_COOKIE['wxid']),array('uid'=>$userinfo['uid']));
						setcookie("wxid",'',time() - 86400, "/");
					}
					if($_COOKIE['unionid']){
						$UserinfoM->UpdateMember(array('unionid'=>''),array('unionid'=>$_COOKIE['unionid']));
						$UserinfoM->UpdateMember(array('unionid'=>$_COOKIE['unionid']),array('uid'=>$userinfo['uid']));
						setcookie("unionid",'',time() - 86400, "/");
					}
					setcookie("uid",$userinfo['uid'],time() + 86400, "/");
					setcookie("username",$userinfo['username'],time() + 86400, "/");
					setcookie("usertype",$userinfo['usertype'],time() + 86400, "/");
					setcookie("salt",$userinfo['salt'],time() + 86400, "/");
					setcookie("shell",md5($userinfo['username'].$userinfo['password'].$userinfo['salt']), time() + 86400,"/");
					if($_COOKIE['wxid']){	
						 $this->layer_msg('绑定成功，请按左上方返回进入微信客户端',9,0,Url('wap').'member/',2); 
					}else{
                        $this->layer_msg('',9,0,Url('wap').'member/',2); 
					}
				}
			}else{
				$data['msg']='数据错误！';
			}
            $this->layer_msg($data['msg'],9,0,'',2);
		}
		if($_GET['usertype']=="2"){
			$this->yunset("headertitle","会员登录");
		}else{
			$this->yunset("headertitle","会员登录");
		}
		$this->seo("login");
		$this->yuntpl(array('wap/login'));
	}
}
?>